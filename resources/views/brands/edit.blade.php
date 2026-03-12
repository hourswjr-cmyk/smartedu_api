@extends('layouts.app')

@section('title', 'Edit Brand')

@section('content')
<div class=" p-6 rounded-lg shadow max-w-2xl">
    <h3 class="text-lg font-semibold mb-4">Edit Brand</h3>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('brands.update', $brand->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1 font-medium">Brand Name</label>
            <input type="text" name="name" value="{{ old('name', $brand->name) }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $brand->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="1" {{ $brand->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$brand->status ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="inline-flex items-center px-4 py-2 border border-blue-600 text-blue-600 rounded hover:bg-blue-600 hover:text-white transition">
            Update Brand
        </button>
    </form>
</div>
@endsection