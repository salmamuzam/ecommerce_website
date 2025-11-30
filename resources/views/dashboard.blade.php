<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{-- Display logged in user's name --}}
            Welcome {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        Home
    </div>
</x-app-layout>
