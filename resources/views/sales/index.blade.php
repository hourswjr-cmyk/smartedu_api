@extends('layouts.app')

@section('title', 'Sales')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Sales List</h3>
        <a href="{{ route('sales.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            Add Sale
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
                <th class="border px-4 py-2">Invoice</th>
                <th class="border px-4 py-2">Customer</th>
                <th class="border px-4 py-2">Date</th>
                <th class="border px-4 py-2">Subtotal</th>
                <th class="border px-4 py-2">Total</th>
                <th class="border px-4 py-2">Actions</th>
                
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $sale->invoice_no }}</td>
                    <td class="border px-4 py-2">{{ $sale->customer->name ?? 'Walk-in Customer' }}</td>
                    <td class="border px-4 py-2">{{ $sale->sale_date }}</td>
                    <td class="border px-4 py-2">{{ $sale->subtotal }}</td>
                    <td class="border px-4 py-2">{{ $sale->total }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-outline-primary">
                            View Invoice
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="border px-4 py-4 text-center">No sales found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $sales->links() }}
    </div>
</div>
@endsection