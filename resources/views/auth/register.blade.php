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

            <div class="m-4 text-sm font-bold leading-tight tracking-tight text-center text-slate-700">
                <span class="flex items-center">
                    <span class="flex-grow border-t border-slate-300"></span>
                    <span class="px-2">OR</span>
                    <span class="flex-grow border-t border-slate-300"></span>
                </span>
            </div>

            <div class="mt-2">
                <a href="{{ url('auth/google') }}" class="inline-flex items-center justify-center w-full px-4 py-2 font-sans text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-lg bg-slate-800 hover:bg-slate-700 focus:bg-slate-700 active:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 disabled:opacity-50">
                    <!-- Google SVG Icon -->
                    <svg class="w-6 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" width="800px" height="800px"
                        viewBox="-0.5 0 48 48" version="1.1">
                        <title>Google-color</title>
                        <desc>Created with Sketch.</desc>
                        <defs></defs>
                        <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Color-" transform="translate(-401.000000, -860.000000)">
                                <g id="Google" transform="translate(401.000000, 860.000000)">
                                    <path d="M9.82727273,24 C9.82727273,22.4757333 10.0804318,21.0144 10.5322727,19.6437333 L2.62345455,13.6042667 C1.08206818,16.7338667 0.213636364,20.2602667 0.213636364,24 C0.213636364,27.7365333 1.081,31.2608 2.62025,34.3882667 L10.5247955,28.3370667 C10.0772273,26.9728 9.82727273,25.5168 9.82727273,24" id="Fill-1" fill="#FBBC05"> </path>
                                    <path d="M23.7136364,10.1333333 C27.025,10.1333333 30.0159091,11.3066667 32.3659091,13.2266667 L39.2022727,6.4 C35.0363636,2.77333333 29.6954545,0.533333333 23.7136364,0.533333333 C14.4268636,0.533333333 6.44540909,5.84426667 2.62345455,13.6042667 L10.5322727,19.6437333 C12.3545909,14.112 17.5491591,10.1333333 23.7136364,10.1333333" id="Fill-2" fill="#EB4335"> </path>
                                    <path d="M23.7136364,37.8666667 C17.5491591,37.8666667 12.3545909,33.888 10.5322727,28.3562667 L2.62345455,34.3946667 C6.44540909,42.1557333 14.4268636,47.4666667 23.7136364,47.4666667 C29.4455,47.4666667 34.9177955,45.4314667 39.0249545,41.6181333 L31.5177727,35.8144 C29.3995682,37.1488 26.7323182,37.8666667 23.7136364,37.8666667" id="Fill-3" fill="#34A853"> </path>
                                    <path d="M46.1454545,24 C46.1454545,22.6133333 45.9318182,21.12 45.6113636,19.7333333 L23.7136364,19.7333333 L23.7136364,28.8 L36.3181818,28.8 C35.6879545,31.8912 33.9724545,34.2677333 31.5177727,35.8144 L39.0249545,41.6181333 C43.3393409,37.6138667 46.1454545,31.6490667 46.1454545,24" id="Fill-4" fill="#4285F4"> </path>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Sign up with Google
                </a>
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
