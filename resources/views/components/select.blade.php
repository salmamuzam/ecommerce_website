@props(['disabled' => false, 'options' => [], 'placeholder' => 'Select an option'])

<div
    x-data="{
        open: false,
        selected: @entangle($attributes->wire('model')),
        options: {{ json_encode($options) }},
        get selectedLabel() {
            if (this.selected && this.options[this.selected]) {
                return this.options[this.selected];
            }
            return '{{ $placeholder }}';
        }
    }"
    class="relative"
>
    <button
        type="button"
        @click="open = !open"
        @click.away="open = false"
        {{ $disabled ? 'disabled' : '' }}
        {!! $attributes->merge(['class' => 'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-teal-600 focus:border-teal-600 block w-full p-2.5 text-left flex justify-between items-center']) !!}
    >
        <span x-text="selectedLabel" :class="{'text-gray-500': !selected}"></span>
        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
    </button>

    <div
        x-show="open"
        class="absolute z-50 w-full bg-white rounded-lg shadow-lg mt-1 max-h-60 overflow-y-auto border border-gray-200"
        style="display: none;"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
    >
        <ul class="py-1">
            <li
                @click="selected = null; open = false"
                class="px-4 py-2 hover:bg-teal-50 hover:text-teal-700 cursor-pointer text-sm text-gray-500 border-b border-gray-100"
            >
                {{ $placeholder }}
            </li>
            @foreach($options as $value => $label)
                <li
                    @click="selected = '{{ $value }}'; open = false"
                    class="px-4 py-2 hover:bg-teal-50 hover:text-teal-700 cursor-pointer text-sm text-gray-700"
                    :class="{'bg-teal-50 text-teal-700': selected == '{{ $value }}'}"
                >
                    {{ $label }}
                </li>
            @endforeach
        </ul>
    </div>
</div>
