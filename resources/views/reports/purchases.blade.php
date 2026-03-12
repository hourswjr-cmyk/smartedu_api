@extends('layouts.app')

@section('title', 'Purchase Report')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h3 class="text-lg font-semibold mb-4">Purchase Report</h3>

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
            <a href="{{ route('reports.purchases') }}" class="bg-gray-600 text-white px-4 py-2 rounded">
                Reset
            </a>
        </div>
    </form>

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Reference</th>
                <th class="border px-4 py-2">Supplier</th>
                <th class="border px-4 py-2">Date</th>
                <th class="border px-4 py-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($purchases as $purchase)
                <tr>
                    <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="border px-4 py-2">{{ $purchase->reference_no }}</td>
                    <td class="border px-4 py-2">{{ $purchase->supplier->name ?? '' }}</td>
                    <td class="border px-4 py-2">{{ $purchase->purchase_date }}</td>
                    <td class="border px-4 py-2">{{ number_format($purchase->total, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="border px-4 py-4 text-center">No purchases found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $purchases->links() }}
    </div>
</div>
@endsection