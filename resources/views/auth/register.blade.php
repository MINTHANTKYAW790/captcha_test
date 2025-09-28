<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {!! NoCaptcha::renderJs() !!}
</head>

<body class="bg-gray-100">
    <div class="flex flex-col min-h-screen">
        <!-- Main Content -->
        <div class="flex flex-col lg:flex-row flex-1 bg-white shadow-2xl">

            <!-- Left: Login -->
            <div class="w-full lg:w-1/2 px-6 md:px-12 flex flex-col justify-center">
                <div class="mb-8 w-20 h-20">
                    <img src="{{ asset('images/logo.png') }}" alt="DailyVibes Logo"
                        class="w-full h-full object-contain">
                </div>

                <h1 class="text-3xl font-bold text-gray-900 mb-2">
                    Register to DailyVibes
                </h1>
                <p class="text-sm text-gray-500 mb-8">
                    Create an account and start connecting with your friends right from your computer.
                </p>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text"
                            name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email"
                            name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4 relative">
                        <label for="password" class="text-sm text-gray-600 mb-2 block">{{ __('Password') }}</label>

                        <input id="password"
                            class="w-full px-4 py-3 bg-gray-200 border-none rounded-xl focus:ring-2 focus:ring-blue-500 pr-10"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                        {{-- Password Toggle Icon using Font Awesome --}}
                        <button type="button"
                            data-target="password"
                            class="toggle-password absolute inset-y-0 right-0 top-6 flex items-center pr-3 text-gray-600 hover:text-gray-900">

                            {{-- Default: Eye Slash (Hidden) --}}
                            <i class="fa-solid fa-eye-slash fa-lg eye-icon" data-state="closed"></i>

                            {{-- Hidden: Eye (Visible) --}}
                            <i class="fa-solid fa-eye fa-lg eye-icon hidden" data-state="open"></i>
                        </button>
                    </div>

                    <div class="mt-4 relative">
                        <label for="password_confirmation" class="text-sm text-gray-600 mb-2 block">{{ __('Confirm Password') }}</label>

                        <input id="password_confirmation"
                            class="w-full px-4 py-3 bg-gray-200 border-none rounded-xl focus:ring-2 focus:ring-blue-500 pr-10"
                            type="password"
                            name="password_confirmation"
                            required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                        {{-- Confirm Password Toggle Icon using Font Awesome --}}
                        <button type="button"
                            data-target="password_confirmation"
                            class="toggle-password absolute inset-y-0 right-0 top-6 flex items-center pr-3 text-gray-600 hover:text-gray-900">

                            {{-- Default: Eye Slash (Hidden) --}}
                            <i class="fa-solid fa-eye-slash fa-lg eye-icon" data-state="closed"></i>

                            {{-- Hidden: Eye (Visible) --}}
                            <i class="fa-solid fa-eye fa-lg eye-icon hidden" data-state="open"></i>
                        </button>
                    </div>

                    <!-- Recaptcha -->
                    <div class="mt-4">
                        <label for="g-recaptcha-response" class="sr-only">reCAPTCHA</label>
                        {!! NoCaptcha::display() !!}
                        @error('g-recaptcha-response')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                        <x-primary-button class="ms-4 mb-2">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Right: Image -->
            <div class="w-full lg:w-1/2">
                <img src="{{ asset('images/selfie.jpg') }}"
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-password');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Get the ID of the target input from the data-target attribute
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);

                    // Find the specific eye icons related to this button
                    const eyeIcons = this.querySelectorAll('.eye-icon');
                    const eyeClosed = Array.from(eyeIcons).find(icon => icon.getAttribute('data-state') === 'closed');
                    const eyeOpen = Array.from(eyeIcons).find(icon => icon.getAttribute('data-state') === 'open');

                    if (passwordInput && eyeClosed && eyeOpen) {
                        // Toggle the type attribute
                        const isPassword = passwordInput.getAttribute('type') === 'password';
                        passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

                        // Toggle the icon visibility
                        eyeOpen.classList.toggle('hidden');
                        eyeClosed.classList.toggle('hidden');
                    }
                });
            });
        });
    </script>
</body>

</html>