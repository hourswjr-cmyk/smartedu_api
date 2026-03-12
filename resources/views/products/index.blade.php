@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Product List</h3>
        <a href="{{ route('products.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            Add Product
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Category</th>
                <th class="border px-4 py-2">Brand</th>
                <th class="border px-4 py-2">SKU</th>
                <th class="border px-4 py-2">Price</th>
                <th class="border px-4 py-2">Qty</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $product->name }}</td>
                    <td class="border px-4 py-2">{{ $product->category->name ?? '' }}</td>
                    <td class="border px-4 py-2">{{ $product->brand->name ?? '' }}</td>
                    <td class="border px-4 py-2">{{ $product->sku }}</td>
                    <td class="border px-4 py-2">{{ $product->selling_price }}</td>
                    <td class="border px-4 py-2">{{ $product->quantity }}</td>
                    <td class="border px-4 py-2">{{ $product->status ? 'Active' : 'Inactive' }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('products.edit', $product->id) }}" class="inline-flex items-center px-3 py-1 border border-red-500 text-red-500 rounded hover:bg-red-500 hover:text-white transition text-sm">
                            Edit
                        </a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-3 py-1 border border-red-500 text-red-500 rounded hover:bg-red-500 hover:text-white transition text-sm">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="border px-4 py-4 text-center">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection