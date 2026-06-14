<button
    {{
        $attributes->merge([
            'type' => 'submit',
            'class' => '
                inline-flex
                items-center
                justify-center
                px-5
                py-3
                bg-gray-900
                border-0
                rounded-xl
                text-white
                font-medium
                text-sm
                cursor-pointer
                hover:bg-black
                transition
            '
        ])
    }}
>
    {{ $slot }}
</button>