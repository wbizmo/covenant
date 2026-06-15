@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge([
        'style' => '
            width:100%;
            margin-top:8px;
            padding:13px 14px;
            border:1px solid #e5e7eb;
            border-radius:12px;
            background:#ffffff;
            color:#111827;
            font-size:14px;
            outline:none;
        '
    ]) }}
>