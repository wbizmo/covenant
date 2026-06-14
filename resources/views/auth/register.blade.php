<x-guest-layout>

    <div style="margin-bottom:28px;">

        <h1 style="
            font-size:28px;
            font-weight:700;
            margin-bottom:8px;
        ">
            Create Account
        </h1>

        <p style="
            color:#6b7280;
            line-height:1.6;
        ">
            Start managing contracts and renewal workflows.
        </p>

    </div>

    <form
        method="POST"
        action="{{ route('register') }}"
        x-data="{ loading:false }"
        @submit="loading=true"
    >

        @csrf

        <div>

            <x-input-label
                for="name"
                value="Full Name"
            />

            <x-text-input
                id="name"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
            />

            <x-input-error
                :messages="$errors->get('name')"
                class="mt-2"
            />

        </div>

        <div style="margin-top:20px;">

            <x-input-label
                for="email"
                value="Email Address"
            />

            <x-text-input
                id="email"
                type="email"
                name="email"
                :value="old('email')"
                required
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
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

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
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

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />

        </div>

        <div style="margin-top:24px;">

            <x-primary-button
                style="width:100%;"
                :disabled="loading"
            >

                <span x-show="!loading">
                    Create Account
                </span>

                <span x-show="loading">
                    Creating Account...
                </span>

            </x-primary-button>

        </div>

        <div style="
            margin-top:20px;
            text-align:center;
            font-size:14px;
            color:#6b7280;
        ">

            Already have an account?

            <a
                href="{{ route('login') }}"
                style="
                    color:#111827;
                    font-weight:600;
                "
            >
                Sign In
            </a>

        </div>

    </form>

</x-guest-layout>