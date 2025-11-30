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
            <h1 class="mb-4 text-xl font-bold leading-tight tracking-tight text-center bg-clip-text text-transparent bg-gradient-to-r from-emerald-700 via-teal-700 to-cyan-700 md:text-2xl">
    Log in to your account
</h1>


            <div>
                <x-label for="login" value="{{ __('Email or Username') }}" />
                <x-icon-input id="login" class="block w-full mt-1" type="text" name="login" :value="old('login')" required
                   placeholder="aleena@gmail.com or aleena"  autofocus autocomplete="username">
                   <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-slate-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                        </svg>
                   </x-slot>
                </x-icon-input>
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-password-input id="password" class="block w-full mt-1" name="password" required
                    autocomplete="current-password"  placeholder="••••••••">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-slate-500">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </x-slot>
                </x-password-input>
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
                <span class="text-sm text-slate-600">
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
