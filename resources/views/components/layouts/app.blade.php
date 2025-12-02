<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>{{ $title ?? "Aaliyah's Collection" }}</title>
    @livewireStyles
</head>

<body>
    <header class="flex shadow-md py-3 px-4 sm:px-10 bg-white min-h-[70px] tracking-wide relative z-50">
        <div class="flex flex-wrap items-center justify-between w-full lg:gap-y-4 gap-y-6 gap-x-4">
            <a href="javascript:void(0)"><img src="images/aaliyah_collection_logo.png" alt="logo" class="w-10" />
            </a>

            <div id="collapseMenu"
                class="max-lg:hidden lg:!block max-lg:before:fixed max-lg:before:bg-black max-lg:before:opacity-40 max-lg:before:inset-0 max-lg:before:z-50">
                <button id="toggleClose"
                    class="lg:hidden fixed top-2 right-4 z-[100] rounded-full bg-white w-9 h-9 flex items-center justify-center border border-gray-200 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 fill-black"
                        viewBox="0 0 320.591 320.591">
                        <path
                            d="M30.391 318.583a30.37 30.37 0 0 1-21.56-7.288c-11.774-11.844-11.774-30.973 0-42.817L266.643 10.665c12.246-11.459 31.462-10.822 42.921 1.424 10.362 11.074 10.966 28.095 1.414 39.875L51.647 311.295a30.366 30.366 0 0 1-21.256 7.288z"
                            data-original="#000000"></path>
                        <path
                            d="M287.9 318.583a30.37 30.37 0 0 1-21.257-8.806L8.83 51.963C-2.078 39.225-.595 20.055 12.143 9.146c11.369-9.736 28.136-9.736 39.504 0l259.331 257.813c12.243 11.462 12.876 30.679 1.414 42.922-.456.487-.927.958-1.414 1.414a30.368 30.368 0 0 1-23.078 7.288z"
                            data-original="#000000"></path>
                    </svg>
                </button>

                <ul
                    class="lg:flex lg:gap-x-10 max-lg:space-y-3 max-lg:fixed max-lg:bg-white max-lg:w-2/3 max-lg:min-w-[300px] max-lg:top-0 max-lg:left-0 max-lg:p-4 max-lg:h-full max-lg:shadow-md max-lg:overflow-auto z-50">
                    <li class="hidden mb-6 max-lg:block">
                        <a href="javascript:void(0)"><img src="images/aaliyah_collection_logo.png" alt="logo"
                                class="w-10" />
                        </a>
                    </li>
                    <li
                        class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 max-lg:px-3 relative lg:after:absolute lg:after:bg-black lg:after:w-0 lg:hover:after:w-full lg:after:h-[2px] lg:after:block lg:after:top-7 lg:after:transition-all lg:after:duration-300">
                        <a href="{{ url('/home') }}" class="text-teal-900 block text-[15px] font-medium">Home</a>
                    </li>
                    <li
                        class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 max-lg:px-3 relative lg:after:absolute lg:after:bg-black lg:after:w-0 lg:hover:after:w-full lg:after:h-[2px] lg:after:block lg:after:top-7 lg:after:transition-all lg:after:duration-300">
                        <a href="{{ route('products.shop') }}" class="text-teal-900 block text-[15px] font-medium">Shop</a>
                    </li>
                    <li
                        class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 max-lg:px-3 relative lg:after:absolute lg:after:bg-black lg:after:w-0 lg:hover:after:w-full lg:after:h-[2px] lg:after:block lg:after:top-7 lg:after:transition-all lg:after:duration-300">
                        <a href="#" class="text-teal-900 block text-[15px] font-medium">Wishlist</a>
                    </li>
                    <li
                        class="max-lg:border-b max-lg:border-gray-300 max-lg:py-3 max-lg:px-3 relative lg:after:absolute lg:after:bg-black lg:after:w-0 lg:hover:after:w-full lg:after:h-[2px] lg:after:block lg:after:top-7 lg:after:transition-all lg:after:duration-300">
                        <a href="{{ route('cart') }}" class="text-teal-900 block text-[15px] font-medium">Cart</a>
                    </li>
                </ul>
            </div>

            <div class="flex items-center space-x-6 max-sm:ml-auto">
                <ul>
                    <li id="profile-dropdown-toggle"
                        class="relative px-1 after:absolute after:bg-black after:w-0 hover:after:w-full after:h-[2px] after:block after:top-8 after:left-0 after:transition-all after:duration-300">
                        @auth
                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full object-cover cursor-pointer border border-gray-200">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                class="cursor-pointer hover:fill-black" viewBox="0 0 512 512">
                                <path
                                    d="M437.02 74.981C388.667 26.629 324.38 0 256 0S123.333 26.629 74.98 74.981C26.629 123.333 0 187.62 0 256s26.629 132.667 74.98 181.019C123.333 485.371 187.62 512 256 512s132.667-26.629 181.02-74.981C485.371 388.667 512 324.38 512 256s-26.629-132.667-74.98-181.019zM256 482c-66.869 0-127.037-29.202-168.452-75.511C113.223 338.422 178.948 290 256 290c-49.706 0-90-40.294-90-90s40.294-90 90-90 90 40.294 90 90-40.294 90-90 90c77.052 0 142.777 48.422 168.452 116.489C383.037 452.798 322.869 482 256 482z"
                                    data-original="#000000" />
                            </svg>
                        @endauth
                        <div id="profile-dropdown-menu"
                            class="bg-white block z-20 shadow-lg py-6 px-6 rounded-sm sm:min-w-[320px] max-sm:min-w-[250px] absolute right-0 top-10">
                            <h6 class="font-semibold text-[15px]">Welcome</h6>
                            <p class="mt-1 text-sm text-gray-500">Mange Your Account</p>
                            <hr class="my-4 border-b-0 border-gray-300" />
                            <ul class="space-y-1.5">
                                <li><a href='javascript:void(0)'
                                        class="text-sm text-gray-500 hover:text-slate-900">Profile</a></li>
                                <li><a href='javascript:void(0)' class="text-sm text-gray-500 hover:text-slate-900">API
                                        Tokens</a></li>
                                <li><a href='javascript:void(0)'
                                        class="text-sm text-gray-500 hover:text-slate-900">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>

                <button id="toggleOpen" class="cursor-pointer lg:hidden ml-7">
                    <svg class="w-7 h-7" fill="#000" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <script>
        // for navbar on small screen size
        var toggleOpen = document.getElementById('toggleOpen');
        var toggleClose = document.getElementById('toggleClose');
        var collapseMenu = document.getElementById('collapseMenu');

        function handleClick() {
            if (collapseMenu.style.display === 'block') {
                collapseMenu.style.display = 'none';
            } else {
                collapseMenu.style.display = 'block';
            }
        }

        toggleOpen.addEventListener('click', handleClick);
        toggleClose.addEventListener('click', handleClick);

        // for profile dropdown
        var toggleDropdown = document.getElementById('profile-dropdown-toggle');
        var dropdownMenu = document.getElementById('profile-dropdown-menu');

        function handleToggle(event) {
            dropdownMenu.classList.toggle('hidden');
        }

        // Add event listener for toggle button
        toggleDropdown.addEventListener('click', function(event) {
            event.stopPropagation();
            handleToggle(event);
        });

        // Add event listener to hide the dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (
                !dropdownMenu.classList.contains('hidden') &&
                !dropdownMenu.contains(event.target) &&
                event.target !== toggleDropdown
            ) {
                dropdownMenu.classList.add('hidden');
            }
        });
    </script>
    <div>
        {{ $slot }}
    </div>
    <footer class="tracking-wide bg-white shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)]">
        <div class="w-full max-w-screen-xl p-4 mx-auto md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="https://flowbite.com/" class="flex items-center mb-4 space-x-3 sm:mb-0 rtl:space-x-reverse">
                    <img src="images/aaliyah_collection_logo.png" class="h-7" alt="Aaliyah's Collection Logo" />
                    <span
                        class="self-center text-2xl font-semibold text-teal-900 text-heading whitespace-nowrap">Aaliyah's
                        Collection</span>
                </a>
                <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-body sm:mb-0">
                    <li>
                        <a href="{{ url('/home') }}" class="text-teal-900 hover:underline me-4 md:me-6">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('products.shop') }}" class="text-teal-900 hover:underline me-4 md:me-6">Shop</a>
                    </li>
                    <li>
                        <a href="#" class="text-teal-900 hover:underline me-4 md:me-6">Wishlist</a>
                    </li>
                    <li>
                        <a href="{{ route('cart') }}" class="text-teal-900 hover:underline">Cart</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-teal-900 sm:mx-auto lg:my-8" />
            <span class="block text-sm text-teal-900 text-body sm:text-center">© 2025 <a href="https://flowbite.com/"
                    class="text-teal-900 hover:underline">Aaliyah's Collection</a>. All Rights Reserved.</span>
        </div>
    </footer>
    @livewireScripts
</body>

</html>
