@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm">Total Products</h3>
            <p class="text-3xl font-bold mt-2">{{ $totalProducts }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm">Total Categories</h3>
            <p class="text-3xl font-bold mt-2">{{ $totalCategories }}</p>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-gray-500 text-sm">Total Brands</h3>
            <p class="text-3xl font-bold mt-2">{{ $totalBrands }}</p>
        </div>
    </div>

    <div class="mt-8 bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-2">Welcome</h3>
        <p>Welcome to the Electric Store Management System.</p>
    </div>
    <br>
    
@endsection