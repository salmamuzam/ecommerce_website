@props(['disabled' => false])

<div class="relative">
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        {{ $icon }}
    </div>
    <input 
        {{ $disabled ? 'disabled' : '' }} 
        {!! $attributes->merge(['class' => 'border-slate-300 focus:border-teal-500 focus:ring-teal-500 rounded-lg shadow-sm font-sans pl-10']) !!}
    >
</div>
