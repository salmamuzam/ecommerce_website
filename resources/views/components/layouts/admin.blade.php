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

<body class="flex flex-col min-h-screen bg-gray-100" x-data="{ sidebarOpen: false }">
    <div class="flex flex-1 relative">
        <!-- Mobile Sidebar Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80 z-40 lg:hidden"></div>

        <!-- Sidebar -->
        <nav :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="bg-white w-[260px] py-8 px-4 flex flex-col shadow-md fixed inset-y-0 left-0 z-50 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto">
            <div class="flex items-center justify-between lg:justify-center mb-6 lg:mb-0">
                <!-- Close Button (Mobile) -->
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="flex flex-col flex-wrap items-center justify-center cursor-pointer">
                <div class="relative">
                    <img class="object-cover w-16 h-16 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>

                <div class="mt-4 text-center">
                    <p class="text-[15px] text-teal-800 font-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                    <p class="text-xs text-teal-600 mt-0.5">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <hr class="mt-6 border-teal-600" />

            <ul class="mt-10 space-y-4">
                <!-- Home (Dashboard) -->
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="text-teal-600 hover:text-teal-800 text-[15px] font-medium flex items-center gap-4 hover:bg-teal-50 rounded px-4 py-2 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span>Home</span>
                    </a>
                </li>

                <!-- Categories -->
                <li>
                    <a href="{{ route('admin.categories') }}"
                        class="text-teal-600 hover:text-teal-800 text-[15px] font-medium flex items-center gap-4 hover:bg-teal-50 rounded px-4 py-2 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                        </svg>
                        <span>Categories</span>
                    </a>
                </li>

                <!-- Products -->
                <li>
                    <a href="javascript:void(0)"
                        class="text-teal-600 hover:text-teal-800 text-[15px] font-medium flex items-center gap-4 hover:bg-teal-50 rounded px-4 py-2 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        <span>Products</span>
                    </a>
                </li>

                <!-- Order History -->
                <li>
                    <a href="javascript:void(0)"
                        class="text-teal-600 hover:text-teal-800 text-[15px] font-medium flex items-center gap-4 hover:bg-teal-50 rounded px-4 py-2 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span>Order History</span>
                    </a>
                </li>
            </ul>

            <hr class="my-10 border-teal-600" />

            <ul class="space-y-4">
                <!-- Profile -->
                <li>
                    <a href="{{ route('profile.show') }}"
                        class="text-teal-600 hover:text-teal-800 text-[15px] font-medium flex items-center gap-4 hover:bg-teal-50 rounded px-4 py-2 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span>Profile</span>
                    </a>
                </li>

                <!-- Logout -->
                <li>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <a href="{{ route('logout') }}" @click.prevent="$root.submit();"
                            class="text-teal-600 hover:text-teal-800 text-[15px] font-medium flex items-center gap-4 hover:bg-teal-50 rounded px-4 py-2 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                            </svg>
                            <span>Logout</span>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 p-6 lg:ml-0">
            <!-- Mobile Header -->
            <div class="lg:hidden flex items-center justify-between mb-6">
                <button @click="sidebarOpen = true" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <div class="flex items-center gap-2 {{ $header_color ?? 'text-gray-800' }}">
                    @if(isset($icon))
                        <div class="w-6 h-6">
                            {!! $icon !!}
                        </div>
                    @endif
                    <span class="text-lg font-bold">{{ $title ?? "Aaliyah's Collection" }}</span>
                </div>
                <div class="w-6"></div> <!-- Spacer -->
            </div>
            {{ $slot }}
        </div>
    </div>
    @livewireScripts
</body>

</html>
