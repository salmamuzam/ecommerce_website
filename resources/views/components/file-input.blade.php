@props(['model', 'preview' => null, 'label' => 'Upload a file', 'accept' => 'image/png, image/jpeg, image/webp'])

<div class="col-span-2">
    <label class="block mb-2 text-sm font-medium text-gray-900">{{ $label }}</label>
    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-300 px-6 py-10">
        <div class="text-center">
            @if ($preview)
                <img src="{{ $preview }}" class="mx-auto h-32 object-cover rounded-lg mb-4">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto size-12 text-gray-300">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
            @endif
            <div class="mt-4 flex text-sm leading-6 text-gray-600 justify-center">
                <label for="{{ $attributes->get('id') ?? md5($model) }}" class="relative cursor-pointer rounded-md bg-white font-semibold text-teal-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-teal-600 focus-within:ring-offset-2 hover:text-teal-500">
                    <span>{{ $preview ? 'Change file' : 'Upload a file' }}</span>
                    <input id="{{ $attributes->get('id') ?? md5($model) }}" type="file" wire:model.live="{{ $model }}" class="sr-only" accept="{{ $accept }}">
                </label>
                <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs leading-5 text-gray-600">PNG, JPG, WebP up to 1MB</p>
        </div>
    </div>
    @error($model) <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    @if($preview && !$errors->has($model)) <span class="text-teal-600 text-xs">Valid file format</span> @endif
</div>
