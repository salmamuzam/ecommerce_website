<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 text-sm font-medium text-teal-600">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h1 class="mb-4 text-xl font-bold leading-tight tracking-tight text-center text-teal-900 md:text-2xl">
                Log in to your account
            </h1>

            <div>
                <x-label for="login" value="{{ __('Email or Username') }}" />
                <x-input id="login" class="block w-full mt-1" type="text" name="login" :value="old('login')" required
                   placeholder="aleena@gmail.com or aleena"  autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                    autocomplete="current-password"  placeholder="••••••••" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="text-sm text-slate-600 ms-2">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-teal-600 underline rounded-md hover:text-teal-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>




            <div class="mt-6">
                <x-button class="justify-center w-full">
                    {{ __('Log in') }}
                </x-button>
            </div>


            <div class="flex items-center justify-center mt-4">
                <span class="text-sm text-gray-600">
                    Don't have an account yet?
                </span>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-sm text-teal-600 underline ms-2 hover:text-teal-800">
                        {{ __('Register') }}
                    </a>
                @endif
            </div>

        </form>
    </x-authentication-card>
</x-guest-layout>
