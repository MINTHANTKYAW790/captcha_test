<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="flex flex-col min-h-screen">
        <!-- Main Content -->
        <div class="flex flex-col lg:flex-row flex-1 bg-white shadow-2xl">
            
            <!-- Left: Login -->
            <div class="w-full lg:w-1/2 px-6 md:px-12 flex flex-col justify-center">
                <div class="mb-8 w-20 h-20">
                    <img src="{{ asset('images/logo.png') }}"
                         alt="DailyVibes Logo"
                         class="w-full h-full object-contain">
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-2">
                    Log In To DailyVibes
                </h1>
                <p class="text-sm text-gray-500 mb-8">
                    Chat, share snaps, and make video calls with your friends. View Stories and Spotlight right from your computer.
                </p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="text-sm text-gray-600 mb-2 block">Email address or Phone number</label>
                        <input id="email"
                               class="w-full px-4 py-3 bg-gray-200 border-none rounded-xl focus:ring-2 focus:ring-blue-500"
                               type="text"
                               name="email"
                               :value="old('email')"
                               required autofocus
                               autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="text-sm text-gray-600 mb-2 block">Password</label>
                        <input id="password"
                               class="w-full px-4 py-3 bg-gray-200 border-none rounded-xl focus:ring-2 focus:ring-blue-500"
                               type="password"
                               name="password"
                               required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!-- Links -->
                    <div class="flex justify-between items-center my-3 text-sm">
                        @if (Route::has('password.request'))
                            <a class="text-gray-500 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800">
                            {{ __('Sign up') }}
                        </a>
                    </div>
                    <!-- Button -->
                    <button type="submit" class="w-full py-3 mb-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition duration-150">
                        {{ __('Login') }}
                    </button>
                </form>
            </div>

            <!-- Right: Image -->
            <div class="w-full lg:w-1/2">
                <img src="{{ asset('images/group.png') }}"
                     alt="DailyVibes Background"
                     class="w-full h-full max-h-screen object-cover object-center">
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-black text-white text-xs p-2 text-center flex items-center justify-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.398 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            Learn what we're doing to help keep <span class="font-bold ml-1">DailyVibes Safe</span>.
        </div>
    </div>
</body>
</html>
