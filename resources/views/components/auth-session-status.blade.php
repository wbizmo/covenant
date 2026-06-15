@props(['status'])

@if ($status)
    <div
        {{ $attributes->merge([
            'style' => '
                margin-bottom:18px;
                padding:14px 16px;
                border-radius:12px;
                background:#dcfce7;
                color:#166534;
                font-size:14px;
                line-height:1.5;
            '
        ]) }}
    >
        {{ $status }}
    </div>
@endif