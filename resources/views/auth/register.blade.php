<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
 <h1 class="mb-4 text-xl font-bold leading-tight tracking-tight text-center text-teal-900 md:text-2xl">
    Sign in to your account
</h1>
            <div>
                <x-label for="first_name" value="{{ __('First Name') }}" />
                <x-input id="first_name" class="block w-full mt-1" type="text" name="first_name"
                    :value="old('first_name')" required autofocus autocomplete="first_name" />
            </div>

            <div class="mt-4">
                <x-label for="last_name" value="{{ __('Last Name') }}" />
                <x-input id="last_name" class="block w-full mt-1" type="text" name="last_name" :value="old('last_name')"
                    required autofocus autocomplete="last_name" />
            </div>

            <div class="mt-4">
                <x-label for="user_name" value="{{ __('Username') }}" />
                <x-input id="user_name" class="block w-full mt-1" type="text" name="user_name" :value="old('user_name')"
                    required autofocus autocomplete="user_name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required
                    autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" class="block w-full mt-1" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-label for="terms">
                                <div class="flex items-center">
                                    <x-checkbox name="terms" id="terms" required />

                                    <div class="ms-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                    'terms_of_service' => '<a target="_blank" href="' . route('terms.show') . '" class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' . __('Terms of Service') . '</a>',
                    'privacy_policy' => '<a target="_blank" href="' . route('policy.show') . '" class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' . __('Privacy Policy') . '</a>',
                ]) !!}
                                    </div>
                                </div>
                            </x-label>
                        </div>
            @endif


            <div class="mt-6">
    <x-button class="justify-center w-full">
        {{ __('Register') }}
    </x-button>
</div>


<div class="flex items-center justify-center mt-4">
    <span class="text-sm text-gray-600">
        Have an account?
    </span>

    @if (Route::has('login'))
        <a href="{{ route('login') }}"
           class="text-sm text-teal-600 underline ms-2 hover:text-teal-800">
            {{ __('Log in') }}
        </a>
    @endif
</div>


        </form>
    </x-authentication-card>
</x-guest-layout>
