<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electric Store Management</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">

<!-- Navbar -->
<nav class="bg-white shadow-md" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Brand -->
            <a href="{{ route('dashboard') }}" class="text-xl font-bold text-blue-700 tracking-tight">Electric Store</a>

            <!-- Desktop Nav Links -->
            <div class="hidden md:flex items-center gap-2">
                <a href="{{ route('dashboard') }}" class="text-blue-600 font-medium px-3 py-2 rounded hover:bg-blue-50 transition">Dashboard</a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('categories.index') }}" class="text-gray-700 font-medium px-3 py-2 rounded border border-gray-300 hover:bg-gray-50 transition">Categories</a>
                        <a href="{{ route('brands.index') }}" class="text-gray-700 font-medium px-3 py-2 rounded border border-gray-300 hover:bg-gray-50 transition">Brands</a>
                        <a href="{{ route('products.index') }}" class="text-gray-700 font-medium px-3 py-2 rounded border border-gray-300 hover:bg-gray-50 transition">Products</a>
                        <a href="{{ route('suppliers.index') }}" class="text-gray-700 font-medium px-3 py-2 rounded border border-gray-300 hover:bg-gray-50 transition">Suppliers</a>
                        <a href="{{ route('customers.index') }}" class="text-gray-700 font-medium px-3 py-2 rounded border border-gray-300 hover:bg-gray-50 transition">Customers</a>
                        <a href="{{ route('reports.sales') }}" class="text-gray-700 font-medium px-3 py-2 rounded border border-gray-300 hover:bg-gray-50 transition">Reports</a>
                    @endif

                    @if(auth()->user()->isCashier())
                        <a href="{{ route('sales.index') }}" class="text-gray-700 font-medium px-3 py-2 rounded border border-gray-300 hover:bg-gray-50 transition">Sales</a>
                    @endif

                    @if(auth()->user()->isStorekeeper())
                        <a href="{{ route('products.index') }}" class="text-gray-700 font-medium px-3 py-2 rounded border border-gray-300 hover:bg-gray-50 transition">Products</a>
                        <a href="{{ route('purchases.index') }}" class="text-gray-700 font-medium px-3 py-2 rounded border border-gray-300 hover:bg-gray-50 transition">Purchases</a>
                    @endif
                @endauth
            </div>

            <!-- Hamburger (mobile) -->
            <button @click="open = !open" class="md:hidden p-2 rounded text-gray-500 hover:bg-gray-100 focus:outline-none">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Nav Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden border-t border-gray-200 px-4 pb-4 pt-2 space-y-1">
        <a href="{{ route('dashboard') }}" class="block text-blue-600 font-medium px-3 py-2 rounded hover:bg-blue-50 transition">Dashboard</a>
        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('categories.index') }}" class="block text-gray-700 font-medium px-3 py-2 rounded hover:bg-gray-50 transition">Categories</a>
                <a href="{{ route('brands.index') }}" class="block text-gray-700 font-medium px-3 py-2 rounded hover:bg-gray-50 transition">Brands</a>
                <a href="{{ route('products.index') }}" class="block text-gray-700 font-medium px-3 py-2 rounded hover:bg-gray-50 transition">Products</a>
                <a href="{{ route('suppliers.index') }}" class="block text-gray-700 font-medium px-3 py-2 rounded hover:bg-gray-50 transition">Suppliers</a>
                <a href="{{ route('customers.index') }}" class="block text-gray-700 font-medium px-3 py-2 rounded hover:bg-gray-50 transition">Customers</a>
                <a href="{{ route('reports.sales') }}" class="block text-gray-700 font-medium px-3 py-2 rounded hover:bg-gray-50 transition">Reports</a>
            @endif

            @if(auth()->user()->isCashier())
                <a href="{{ route('sales.index') }}" class="block text-gray-700 font-medium px-3 py-2 rounded hover:bg-gray-50 transition">Sales</a>
            @endif

            @if(auth()->user()->isStorekeeper())
                <a href="{{ route('products.index') }}" class="block text-gray-700 font-medium px-3 py-2 rounded hover:bg-gray-50 transition">Products</a>
                <a href="{{ route('purchases.index') }}" class="block text-gray-700 font-medium px-3 py-2 rounded hover:bg-gray-50 transition">Purchases</a>
            @endif
        @endauth
    </div>
</nav>

<!-- Header -->
<header class="bg-white shadow px-6 py-4 flex justify-between items-center">
    <h2 class="text-xl font-semibold">@yield('title')</h2>

    <div class="flex items-center gap-4">
        <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                Logout
            </button>
        </form>
    </div>
</header>

<main class="max-w-7xl mx-auto p-6">
    @yield('content')
</main>

</body>
</html>