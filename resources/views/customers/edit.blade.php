@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-3xl">
    <h3 class="text-lg font-semibold mb-4">Edit Customer</h3>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block mb-1 font-medium">Name</label>
                <input type="text" name="name" value="{{ old('name', $customer->name) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" value="{{ old('email', $customer->email) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block mb-1 font-medium">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2">
                    <option value="1" {{ old('status', $customer->status) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $customer->status) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <div class="md:col-span-2">
                <label class="block mb-1 font-medium">Address</label>
                <textarea name="address" class="w-full border rounded px-3 py-2">{{ old('address', $customer->address) }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-outline-primary">
            Update Customer
        </button>
    </form>
</div>
@endsection