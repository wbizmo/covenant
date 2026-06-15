@props(['messages'])

@if ($messages)
    <ul
        {{ $attributes->merge([
            'style' => '
                margin-top:8px;
                list-style:none;
                color:#dc2626;
                font-size:13px;
                line-height:1.5;
            '
        ]) }}
    >
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif