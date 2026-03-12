@extends('layouts.app')

@section('title', 'Brands')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Brand List</h3>
        <a href="{{ route('brands.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            Add Brand
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
                <th class="border px-4 py-2">Slug</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($brands as $brand)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $brand->name }}</td>
                    <td class="border px-4 py-2">{{ $brand->slug }}</td>
                    <td class="border px-4 py-2">{{ $brand->status ? 'Active' : 'Inactive' }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('brands.edit', $brand->id) }}"
                           class="inline-flex items-center px-3 py-1 border border-red-500 text-red-500 rounded hover:bg-red-500 hover:text-white transition text-sm">
                            Edit
                        </a>

                        <form action="{{ route('brands.destroy', $brand->id) }}"
                              method="POST"
                              class="inline-block"
                              onsubmit="return confirm('Delete this brand?')">
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
                    <td colspan="5" class="border px-4 py-4 text-center">No brands found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $brands->links() }}
    </div>
</div>
@endsection