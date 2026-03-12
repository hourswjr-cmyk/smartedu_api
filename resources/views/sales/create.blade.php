@extends('layouts.app')

@section('title', 'Add Sale')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-5xl">
    <h3 class="text-lg font-semibold mb-4">Create Sale</h3>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block mb-1 font-medium">Customer</label>
                <select name="customer_id" class="w-full border rounded px-3 py-2">
                    <option value="">Walk-in Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block mb-1 font-medium">Sale Date</label>
                <input type="date" name="sale_date" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Invoice No</label>
                <input type="text" name="invoice_no" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <div id="items-wrapper">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-3 item-row">
                <div>
                    <label class="block mb-1 font-medium">Product</label>
                    <select name="product_id[]" class="w-full border rounded px-3 py-2">
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->quantity }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Quantity</label>
                    <input type="number" name="quantity[]" class="w-full border rounded px-3 py-2" min="1">
                </div>

                <div>
                    <label class="block mb-1 font-medium">Unit Price</label>
                    <input type="number" step="0.01" name="unit_price[]" class="w-full border rounded px-3 py-2" min="0">
                </div>
            </div>
        </div>

        <button type="button" onclick="addRow()" class="mb-4 bg-gray-700 text-white px-4 py-2 rounded">
            Add More Item
        </button>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <label class="block mb-1 font-medium">Discount</label>
                <input type="number" step="0.01" name="discount" value="0" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Tax</label>
                <input type="number" step="0.01" name="tax" value="0" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Note</label>
                <input type="text" name="note" class="w-full border rounded px-3 py-2">
            </div>
        </div>

        <button type="submit" class="btn btn-outline-primary">
            Save Sale
        </button>
    </form>
</div>

<script>
function addRow() {
    const wrapper = document.getElementById('items-wrapper');
    const firstRow = wrapper.querySelector('.item-row');
    const newRow = firstRow.cloneNode(true);

    newRow.querySelectorAll('input').forEach(input => input.value = '');
    newRow.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

    wrapper.appendChild(newRow);
}
</script>
@endsection