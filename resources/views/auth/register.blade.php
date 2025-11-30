<x-guest-layout>
    <x-authentication-card class="py-8" width="sm:max-w-2xl">
        <x-slot name="logo">
            <div class="mt-4">
                <x-authentication-card-logo />
            </div>
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
  <h1 class="mb-4 text-xl font-bold leading-tight tracking-tight text-center bg-clip-text text-transparent bg-gradient-to-r from-emerald-700 via-teal-700 to-cyan-700 md:text-2xl">
    Sign in to your account
</h1>



            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <x-label for="first_name" value="{{ __('First Name') }}" />
                    <x-icon-input id="first_name" class="block w-full mt-1" type="text" name="first_name" :value="old('first_name')"
                       placeholder="Fathima"  required autofocus autocomplete="first_name">
                       <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-slate-500">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                       </x-slot>
                    </x-icon-input>
                </div>

                <div>
                    <x-label for="last_name" value="{{ __('Last Name') }}" />
                    <x-icon-input id="last_name" class="block w-full mt-1" type="text" name="last_name" :value="old('last_name')"
                       placeholder="Aleena"  required autofocus autocomplete="last_name">
                       <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-slate-500">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                       </x-slot>
                    </x-icon-input>
                </div>

                <div>
                    <x-label for="user_name" value="{{ __('Username') }}" />
                    <x-icon-input id="user_name" class="block w-full mt-1" type="text" name="user_name" :value="old('user_name')"
                       placeholder="aleena"  required autofocus autocomplete="user_name">
                       <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-slate-500">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                            </svg>
                       </x-slot>
                    </x-icon-input>
                </div>

                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-icon-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                       placeholder="aleena@gmail.com"  required autocomplete="username">
                       <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-slate-500">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                       </x-slot>
                    </x-icon-input>
                </div>

                <div>
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-password-input id="password" class="block w-full mt-1" name="password" required
                       placeholder="••••••••"  autocomplete="new-password">
                       <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-slate-500">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                       </x-slot>
                    </x-password-input>
                </div>

                <div>
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-password-input id="password_confirmation" class="block w-full mt-1"
                         placeholder="••••••••" name="password_confirmation" required autocomplete="new-password">
                         <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-slate-500">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>
                         </x-slot>
                    </x-password-input>
                </div>
            </div>
            

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="text-sm text-teal-600 underline rounded-md hover:teal-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:teal-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="text-sm text-teal-600 underline rounded-md hover:text-teal-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
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
                <span class="text-sm text-slate-600">
                    Already have an account?
                </span>

                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="text-sm text-teal-600 underline ms-2 hover:text-teal-800">
                        {{ __('Log in') }}
                    </a>
                @endif
            </div>


        </form>
    </x-authentication-card>
</x-guest-layout>
