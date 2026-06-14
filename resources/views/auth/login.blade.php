<x-guest-layout>

    <div style="margin-bottom:28px;">

        <h1 style="
            font-size:28px;
            font-weight:700;
            margin-bottom:8px;
        ">
            Welcome Back
        </h1>

        <p style="
            color:#6b7280;
            line-height:1.6;
        ">
            Sign in to access your contracts and renewals.
        </p>

    </div>

    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    <form
        method="POST"
        action="{{ route('login') }}"
        x-data="{ loading:false }"
        @submit="loading=true"
    >

        @csrf

        <div>

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
                autofocus
                autocomplete="username"
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
                autocomplete="current-password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>

        <div style="
            margin-top:20px;
            display:flex;
            justify-content:space-between;
            align-items:center;
        ">

            <label style="
                display:flex;
                align-items:center;
                gap:8px;
                font-size:14px;
                color:#6b7280;
            ">

                <input
                    type="checkbox"
                    name="remember"
                >

                Remember me

            </label>

            @if(Route::has('password.request'))

                <a
                    href="{{ route('password.request') }}"
                    style="
                        font-size:14px;
                        color:#111827;
                    "
                >
                    Forgot password?
                </a>

            @endif

        </div>

        <div style="margin-top:24px;">

            <x-primary-button
                style="
                    width:100%;
                "
                :disabled="loading"
            >

                <span x-show="!loading">
                    Sign In
                </span>

                <span x-show="loading">
                    Signing In...
                </span>

            </x-primary-button>

        </div>

        <div style="
            margin-top:20px;
            text-align:center;
            font-size:14px;
            color:#6b7280;
        ">

            Don't have an account?

            <a
                href="{{ route('register') }}"
                style="
                    color:#111827;
                    font-weight:600;
                "
            >
                Create Account
            </a>

        </div>

    </form>

</x-guest-layout>