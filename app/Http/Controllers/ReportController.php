<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $query = Sale::with('customer')->latest();

        if ($request->filled('from')) {
            $query->whereDate('sale_date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('sale_date', '<=', $request->to);
        }

        $sales = $query->paginate(10)->withQueryString();

        return view('reports.sales', compact('sales'));
    }

    public function purchases(Request $request)
    {
        $query = Purchase::with('supplier')->latest();

        if ($request->filled('from')) {
            $query->whereDate('purchase_date', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('purchase_date', '<=', $request->to);
        }

        $purchases = $query->paginate(10)->withQueryString();

        return view('reports.purchases', compact('purchases'));
    }

    public function lowStock()
    {
        $products = Product::with(['category', 'brand'])
            ->whereColumn('quantity', '<=', 'reorder_level')
            ->latest()
            ->paginate(10);

        return view('reports.low-stock', compact('products'));
    }
}