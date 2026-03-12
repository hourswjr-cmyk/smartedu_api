<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $sale->invoice_no }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body class="bg-gray-100 p-6">
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <h1 class="text-3xl font-bold">Electric Store</h1>
                <p class="text-gray-600">Sales Invoice</p>
            </div>
            <div class="col-lg-2">
                <p><strong>Invoice No:</strong> {{ $sale->invoice_no }}</p>
                <p><strong>Date:</strong> {{ $sale->sale_date }}</p>
                <p><strong>Cashier:</strong> {{ $sale->user->name ?? 'N/A' }}</p>
            </div>
            <div class="mb-6">
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
            <table class="w-full border border-gray-300 mb-6">
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
        <div class="flex justify-end">
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
            <a href="{{ route('sales.index') }}" class="bg-gray-700 text-white px-4 py-2 rounded">
                Back
            </a>
            <button onclick="window.print()" class="btn btn-outline-primary">
                Print Invoice
            </button>
        </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>