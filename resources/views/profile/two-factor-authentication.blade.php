<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Two-Factor Authentication') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('status') == "two-factor-authentication-enabled")
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ __('Two-factor authentication has been enabled.') }}
                        </div>
                    @endif

                    @if (session('status') == "two-factor-authentication-disabled")
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ __('Two-factor authentication has been disabled.') }}
                        </div>
                    @endif

                    @if (! Auth::user()->two_factor_secret)
                        {{-- Enable 2FA --}}
                        <form method="POST" action="{{ route('two-factor.enable') }}">
                            @csrf

                            <div>
                                <h3 class="text-lg font-medium text-gray-900">
                                    {{ __('Enable Two-Factor Authentication') }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('When two-factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
                                </p>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Enable') }}
                                </button>
                            </div>
                        </form>
                    @else
                        {{-- Disable 2FA --}}
                        <form method="POST" action="{{ route('two-factor.disable') }}">
                            @csrf
                            @method('DELETE')
                            <h3 class="text-lg font-medium text-gray-900">
                                {{ __('Disable Two-Factor Authentication') }}
                            </h3>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Two-factor authentication is currently enabled. Disable it to remove this extra layer of security.') }}
                            </p>
                            <div class="mt-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:shadow-outline-red disabled:opacity-25 transition ease-in-out duration-150">
                                    {{ __('Disable') }}
                                </button>
                            </div>
                        </form>

                        {{-- Show QR code and recovery codes --}}
                        @if (Auth::user()->two_factor_secret)
                            <div class="mt-4">
                                <h3 class="text-lg font-medium text-gray-900">
                                    {{ __('Scan this QR code to set up Two-Factor Authentication') }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Use your phone\'s authenticator app to scan the following QR code.') }}
                                </p>
                                <div class="mt-4 inline-block">
                                    {!! Auth::user()->twoFactorQrCodeSvg() !!}
                                </div>

                                <h3 class="mt-4 text-lg font-medium text-gray-900">
                                    {{ __('Recovery Codes') }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{ __('Store these recovery codes in a secure password manager. They can be used to recover your account if you lose your phone.') }}
                                </p>
                                <div class="mt-4 p-4 font-mono text-sm bg-gray-100 rounded-md">
                                    @foreach (json_decode(decrypt(Auth::user()->two_factor_recovery_codes), true) as $code)
                                        <div>{{ $code }}</div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>