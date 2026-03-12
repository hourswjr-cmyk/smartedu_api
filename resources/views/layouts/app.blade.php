<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electric Store Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<div class="container">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('dashboard') }}">Electric Store</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="justify-content-end collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a href="{{ route('dashboard') }}" class="btn text-primary me-1">Dashboard</a>
        @auth
    @if(auth()->user()->isAdmin())
        <a href="{{ route('categories.index') }}" class="btn btn-outline-primary me-1">Categories</a>
        <a href="{{ route('brands.index') }}" class="btn btn-outline-primary me-1">Brands</a>
        <a href="{{ route('products.index') }}" class="btn btn-outline-primary me-1">Products</a>
        <a href="{{ route('suppliers.index') }}" class="btn btn-outline-primary me-1">Suppliers</a>
        <a href="{{ route('customers.index') }}" class="btn btn-outline-primary me-1">Customers</a>
        <a href="{{ route('reports.sales') }}" class="btn btn-outline-primary me-1">Reports</a>
    @endif

    @if(auth()->user()->isCashier())
        <a href="{{ route('sales.index') }}" class="btn btn-outline-primary me-1">Sales</a>
    @endif

    @if(auth()->user()->isStorekeeper())
        <a href="{{ route('products.index') }}" class="btn btn-outline-primary me-1">Products</a>
        <a href="{{ route('purchases.index') }}" class="btn btn-outline-primary me-1">Purchases</a>
    @endif
@endauth
      </div>
    </div>
  </div>
    </nav>
    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <h2 class="text-xl font-semibold">@yield('title')</h2>

                <div class="flex items-center gap-4">
                    <span>{{ auth()->user()->name }}</span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <main class="p-6">
                @yield('content')
            </main>
</div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>