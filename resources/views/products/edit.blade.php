@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-3xl">
    <h3 class="text-lg font-semibold mb-4">Edit Product</h3>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">Category</label>
                <select name="category_id" class="w-full border rounded px-3 py-2">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Brand</label>
                <select name="brand_id" class="w-full border rounded px-3 py-2">
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Product Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">SKU</label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Cost Price</label>
                <input type="number" step="0.01" name="cost_price" value="{{ old('cost_price', $product->cost_price) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Selling Price</label>
                <input type="number" step="0.01" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Quantity</label>
                <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Reorder Level</label>
                <input type="number" name="reorder_level" value="{{ old('reorder_level', $product->reorder_level) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Unit</label>
                <input type="text" name="unit" value="{{ old('unit', $product->unit) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>

        <div class="mt-4">
            <label class="block mb-1 font-medium">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $product->description) }}</textarea>
        </div>

        <button type="submit" class="mt-4 bg-green-600 text-white px-4 py-2 rounded">
            Update Product
        </button>
    </form>
</div>
@endsection