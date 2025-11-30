@props(['width' => 'sm:max-w-md'])

<div {{ $attributes->merge(['class' => 'min-h-screen flex flex-col justify-center items-center pt-6 sm:pt-0 bg-[#F2F3F6] px-4 sm:px-0']) }}>
    <div>
        {{ $logo }}
    </div>

    <div class="w-full {{ $width }} mt-6 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
        {{ $slot }}
    </div>
</div>
