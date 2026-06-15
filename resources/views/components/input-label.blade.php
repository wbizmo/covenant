@props(['value'])

<label
    {{ $attributes->merge([
        'style' => '
            display:block;
            font-size:13px;
            font-weight:600;
            color:#374151;
        '
    ]) }}
>
    {{ $value ?? $slot }}
</label>