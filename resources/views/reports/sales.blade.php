@extends('layouts.app')

@section('title', 'Sales Report')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h3 class="text-lg font-semibold mb-4">Sales Report</h3>

    <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div>
            <label class="block mb-1 font-medium">From</label>
            <input type="date" name="from" value="{{ request('from') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block mb-1 font-medium">To</label>
            <input type="date" name="to" value="{{ request('to') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div class="flex items-end gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Filter
            </button>
            <a href="{{ route('reports.sales') }}" class="bg-gray-600 text-white px-4 py-2 rounded">
                Reset
            </a>
        </div>
    </form>

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Invoice</th>
                <th class="border px-4 py-2">Customer</th>
                <th class="border px-4 py-2">Date</th>
                <th class="border px-4 py-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $sale->invoice_no }}</td>
                    <td class="border px-4 py-2">{{ $sale->customer->name ?? 'Walk-in Customer' }}</td>
                    <td class="border px-4 py-2">{{ $sale->sale_date }}</td>
                    <td class="border px-4 py-2">{{ number_format($sale->total, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border px-4 py-4 text-center">No sales found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $sales->links() }}
    </div>
</div>
@endsection