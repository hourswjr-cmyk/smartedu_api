@extends('layouts.app')

@section('title', 'Add Brand')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-2xl">
    <h3 class="text-lg font-semibold mb-4">Create Brand</h3>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('brands.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 font-medium">Brand Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Description</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-outline-primary">
            Save Brand
        </button>
    </form>
</div>
@endsection