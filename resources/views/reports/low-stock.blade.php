@extends('layouts.app')

@section('title', 'Low Stock Report')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h3 class="text-lg font-semibold mb-4">Low Stock Products</h3>

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Product</th>
                <th class="border px-4 py-2">Category</th>
                <th class="border px-4 py-2">Brand</th>
                <th class="border px-4 py-2">Quantity</th>
                <th class="border px-4 py-2">Reorder Level</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $product->name }}</td>
                    <td class="border px-4 py-2">{{ $product->category->name ?? '' }}</td>
                    <td class="border px-4 py-2">{{ $product->brand->name ?? '' }}</td>
                    <td class="border px-4 py-2">{{ $product->quantity }}</td>
                    <td class="border px-4 py-2">{{ $product->reorder_level }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border px-4 py-4 text-center">No low stock products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection