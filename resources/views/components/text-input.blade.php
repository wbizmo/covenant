@props([
    'disabled' => false
])

<input
    @disabled($disabled)

    {{ $attributes->merge([
        'class' => '
            w-full
            mt-2
            px-4
            py-3
            border
            border-gray-200
            rounded-xl
            bg-white
            text-gray-900
            placeholder-gray-400
            focus:border-gray-900
            focus:ring-0
            focus:outline-none
            transition
        '
    ]) }}
>