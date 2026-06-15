<button
    {{
        $attributes->merge([
            'type' => 'submit',
            'style' => '
                display:inline-flex;
                align-items:center;
                justify-content:center;
                gap:8px;
                padding:13px 18px;
                border:0;
                border-radius:12px;
                background:#111827;
                color:#ffffff;
                font-size:14px;
                font-weight:600;
                cursor:pointer;
                width:auto;
            '
        ])
    }}
>
    {{ $slot }}
</button>