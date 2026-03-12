<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Login')</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="contianer-fluid position-relative background">
        <img src="{{ asset('storage/img/bg.png') }}" alt="background" width="100%" height="100%">
    </div>
    <div class="conatiner position-absolute top-50 start-50 translate-middle">
        <div class="row">
            
            <div class="col-lg-12 bg-light p-4 rounded">
                <h3>Login</h3>
                    <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label class="mt-4 " for="email" :value="('Email')" /> <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <x-text-input  id="email" class="emailInput" type="email" name="email" :value="old('email')" required  placeholder="Enter your email"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-2">
                        <x-input-label for="password" :value="('Password')" /><span>&nbsp;</span>

                        <x-text-input id="password" class="pwInput"
                                        type="password"
                                        name="password"
                                        required 
                                        placeholder="Password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="flex items-center">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                {{ ('Forgot your password?') }}
                            </a>
                        @endif

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ ('Remember me') }}</span>
                        </label>
                    </div>

                    


                        <x-primary-button class=" login_btn">
                            {{ ('Log in') }}
                        </x-primary-button>
                    </div>
                    <br>
                    <div class="text-center">
                        <a href="{{ route('register') }}" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Don't have an account? {{ ('Register') }}</a>
                    </div>
                </form> 
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>

