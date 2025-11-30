@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-rose-900">{{ __('Whoops! Something went wrong.') }}</div>

        <ul class="mt-3 text-sm list-disc list-inside text-rose-900">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
