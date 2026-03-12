<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('customer')->latest()->paginate(10);
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::where('status', 1)->get();
        $products = Product::where('status', 1)->get();

        return view('sales.create', compact('customers', 'products'));
    }
    public function show(Sale $sale)
    {
        $sale->load(['customer', 'items.product', 'user']);
        return view('sales.show', compact('sale'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'sale_date' => 'required|date',
            'invoice_no' => 'required|unique:sales,invoice_no',
            'product_id' => 'required|array|min:1',
            'product_id.*' => 'required|exists:products,id',
            'quantity' => 'required|array|min:1',
            'quantity.*' => 'required|integer|min:1',
            'unit_price' => 'required|array|min:1',
            'unit_price.*' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request) {
            $subtotal = 0;

            $sale = Sale::create([
                'customer_id' => $request->customer_id,
                'sale_date' => $request->sale_date,
                'invoice_no' => $request->invoice_no,
                'subtotal' => 0,
                'discount' => $request->discount ?? 0,
                'tax' => $request->tax ?? 0,
                'total' => 0,
                'note' => $request->note,
                'created_by' => auth()->id(),
            ]);

            foreach ($request->product_id as $index => $productId) {
                $qty = (int) $request->quantity[$index];
                $unitPrice = (float) $request->unit_price[$index];

                $product = Product::findOrFail($productId);

                if ($product->quantity < $qty) {
                    abort(422, 'Not enough stock for product: ' . $product->name);
                }

                $lineTotal = $qty * $unitPrice;

                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $productId,
                    'quantity' => $qty,
                    'unit_price' => $unitPrice,
                    'total_price' => $lineTotal,
                ]);

                $product->decrement('quantity', $qty);

                $subtotal += $lineTotal;
            }

            $total = $subtotal - ($request->discount ?? 0) + ($request->tax ?? 0);

            $sale->update([
                'subtotal' => $subtotal,
                'total' => $total,
            ]);
        });

        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
    }
}