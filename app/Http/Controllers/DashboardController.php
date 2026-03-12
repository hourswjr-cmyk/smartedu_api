<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalProducts' => Product::count(),
            'totalCategories' => Category::count(),
            'totalBrands' => Brand::count(),
        ]);
    }
}