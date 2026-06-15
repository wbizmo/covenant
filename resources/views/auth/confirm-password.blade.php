<x-guest-layout>

    <div style="margin-bottom:28px;">

        <h1 style="
            font-size:28px;
            font-weight:700;
            margin-bottom:8px;
        ">
            Confirm Password
        </h1>

        <p style="
            color:#6b7280;
            line-height:1.6;
        ">
            Please confirm your password before continuing.
        </p>

    </div>

    <form
        method="POST"
        action="{{ route('password.confirm') }}"
        x-data="{ loading:false }"
        @submit="loading=true"
    >

        @csrf

        <div>

            <x-input-label
                for="password"
                value="Password"
            />

            <x-text-input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>

        <div style="margin-top:24px;">

            <x-primary-button
                style="width:100%;"
                x-bind:disabled="loading"
            >

                <span x-show="!loading">
                    Confirm Password
                </span>

                <span x-show="loading">
                    Confirming...
                </span>

            </x-primary-button>

        </div>

    </form>

</x-guest-layout>