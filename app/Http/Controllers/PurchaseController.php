<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('supplier')->latest()->paginate(10);
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::where('status', 1)->get();
        $products = Product::where('status', 1)->get();

        $latestPurchase = Purchase::latest('id')->first();
        $nextRefNo = 'PUR-' . str_pad($latestPurchase ? $latestPurchase->id + 1 : 1, 6, '0', STR_PAD_LEFT);

        return view('purchases.create', compact('suppliers', 'products', 'nextRefNo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'purchase_date' => 'required|date',
            'reference_no' => 'required|unique:purchases,reference_no',
            'product_id' => 'required|array|min:1',
            'product_id.*' => 'required|exists:products,id',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1',
            'unit_cost' => 'required|array|min:1',
            'unit_cost.*' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $subtotal = 0;

            $purchase = Purchase::create([
                'supplier_id' => $request->supplier_id,
                'purchase_date' => $request->purchase_date,
                'reference_no' => $request->reference_no,
                'subtotal' => 0,
                'discount' => $request->discount ?? 0,
                'tax' => $request->tax ?? 0,
                'total' => 0,
                'note' => $request->note,
                'created_by' => auth()->id(),
            ]);

            foreach ($request->product_id as $index => $productId) {
                $qty = (int) $request->quantity[$index];
                $unitCost = (float) $request->unit_cost[$index];
                $lineTotal = $qty * $unitCost;

                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'unit_cost' => $unitCost,
                    'total_cost' => $lineTotal,
                ]);

                $product = Product::findOrFail($productId);
                $product->increment('quantity', $qty);

                $subtotal += $lineTotal;
            }

            $total = $subtotal - ($request->discount ?? 0) + ($request->tax ?? 0);

            $purchase->update([
                'subtotal' => $subtotal,
                'total' => $total,
            ]);
        });

        return redirect()->route('purchases.index')->with('success', 'Purchase created successfully.');
    }
}