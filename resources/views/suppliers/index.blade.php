@extends('layouts.app')

@section('title', 'Suppliers')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Supplier List</h3>
        <a href="{{ route('suppliers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            Add Supplier
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
                <th class="border px-4 py-2">Company</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Phone</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($suppliers as $supplier)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $supplier->name }}</td>
                    <td class="border px-4 py-2">{{ $supplier->company_name }}</td>
                    <td class="border px-4 py-2">{{ $supplier->email }}</td>
                    <td class="border px-4 py-2">{{ $supplier->phone }}</td>
                    <td class="border px-4 py-2">{{ $supplier->status ? 'Active' : 'Inactive' }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn btn-outline-danger">
                            Edit
                        </a>
                        <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this supplier?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="border px-4 py-4 text-center">No suppliers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $suppliers->links() }}
    </div>
</div>
@endsection