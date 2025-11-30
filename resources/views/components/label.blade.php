@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-slate-700 font-sans']) }}>
    {{ $value ?? $slot }}
</label>
