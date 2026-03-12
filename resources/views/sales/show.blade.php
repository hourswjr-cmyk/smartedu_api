<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $sale->invoice_no }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Invoice Header -->
        <div class="flex justify-between items-start mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Electric Store</h1>
                <p class="text-gray-600">Sales Invoice</p>
            </div>
            <div class="text-right">
                <p><strong>Invoice No:</strong> {{ $sale->invoice_no }}</p>
                <p><strong>Date:</strong> {{ $sale->sale_date }}</p>
                <p><strong>Cashier:</strong> {{ $sale->user->name ?? 'N/A' }}</p>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
            <h2 class="text-lg font-semibold mb-2">Customer Information</h2>
            @if($sale->customer)
                <p><strong>Name:</strong> {{ $sale->customer->name }}</p>
                <p><strong>Email:</strong> {{ $sale->customer->email }}</p>
                <p><strong>Phone:</strong> {{ $sale->customer->phone }}</p>
                <p><strong>Address:</strong> {{ $sale->customer->address }}</p>
            @else
                <p>Walk-in Customer</p>
            @endif
        </div>

        <!-- Items Table -->
        <table class="w-full border border-gray-300 mb-6 bg-white rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">#</th>
                    <th class="border px-4 py-2 text-left">Product</th>
                    <th class="border px-4 py-2 text-left">Qty</th>
                    <th class="border px-4 py-2 text-left">Unit Price</th>
                    <th class="border px-4 py-2 text-left">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->items as $item)
                    <tr>
                        <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border px-4 py-2">{{ $item->product->name ?? '' }}</td>
                        <td class="border px-4 py-2">{{ $item->quantity }}</td>
                        <td class="border px-4 py-2">{{ number_format($item->unit_price, 2) }}</td>
                        <td class="border px-4 py-2">{{ number_format($item->total_price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="flex justify-end mb-6">
            <div class="w-full max-w-sm">
                <div class="flex justify-between py-2 border-b">
                    <span>Subtotal</span>
                    <span>{{ number_format($sale->subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between py-2 border-b">
                    <span>Discount</span>
                    <span>{{ number_format($sale->discount, 2) }}</span>
                </div>
                <div class="flex justify-between py-2 border-b">
                    <span>Tax</span>
                    <span>{{ number_format($sale->tax, 2) }}</span>
                </div>
                <div class="flex justify-between py-2 font-bold text-lg">
                    <span>Total</span>
                    <span>{{ number_format($sale->total, 2) }}</span>
                </div>
            </div>
        </div>

        @if($sale->note)
            <div class="mt-6">
                <h3 class="font-semibold">Note</h3>
                <p>{{ $sale->note }}</p>
            </div>
        @endif

        <div class="mt-8 flex gap-3 print:hidden">
            <a href="{{ route('sales.index') }}" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-800 transition">
                Back
            </a>
            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-blue-600 text-blue-600 rounded hover:bg-blue-600 hover:text-white transition">
                Print Invoice
            </button>
        </div>
    </div>
</body>
</html>