@extends('layouts.app')

@section('title', 'Purchases')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold">Purchase List</h3>
        <a href="{{ route('purchases.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            Add Purchase
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
                <th class="border px-4 py-2">Reference</th>
                <th class="border px-4 py-2">Supplier</th>
                <th class="border px-4 py-2">Date</th>
                <th class="border px-4 py-2">Subtotal</th>
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
                    <td class="border px-4 py-2">{{ $purchase->subtotal }}</td>
                    <td class="border px-4 py-2">{{ $purchase->total }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="border px-4 py-4 text-center">No purchases found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $purchases->links() }}
    </div>
</div>
@endsection