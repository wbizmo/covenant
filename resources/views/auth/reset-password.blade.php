<x-guest-layout>

    <div style="margin-bottom:28px;">

        <h1 style="
            font-size:28px;
            font-weight:700;
            margin-bottom:8px;
        ">
            Choose New Password
        </h1>

        <p style="
            color:#6b7280;
            line-height:1.6;
        ">
            Create a new password for your Covenant account.
        </p>

    </div>

    <form
        method="POST"
        action="{{ route('password.store') }}"
        x-data="{ loading:false }"
        @submit="loading=true"
    >

        @csrf

        <input
            type="hidden"
            name="token"
            value="{{ $request->route('token') }}"
        >

        <div>

            <x-input-label
                for="email"
                value="Email Address"
            />

            <x-text-input
                id="email"
                type="email"
                name="email"
                :value="old('email', $request->email)"
                required
            />

        </div>

        <div style="margin-top:20px;">

            <x-input-label
                for="password"
                value="Password"
            />

            <x-text-input
                id="password"
                type="password"
                name="password"
                required
            />

        </div>

        <div style="margin-top:20px;">

            <x-input-label
                for="password_confirmation"
                value="Confirm Password"
            />

            <x-text-input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
            />

        </div>

        <div style="margin-top:24px;">

            <x-primary-button
                style="width:100%;"
                :disabled="loading"
            >

                <span x-show="!loading">
                    Reset Password
                </span>

                <span x-show="loading">
                    Resetting...
                </span>

            </x-primary-button>

        </div>

    </form>

</x-guest-layout>