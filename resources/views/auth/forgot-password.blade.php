<x-guest-layout>

    <div style="margin-bottom:28px;">

        <h1 style="
            font-size:28px;
            font-weight:700;
            margin-bottom:8px;
        ">
            Reset Password
        </h1>

        <p style="
            color:#6b7280;
            line-height:1.6;
        ">
            Enter your email address and we'll send you a password reset link.
        </p>

    </div>

    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    <form
        method="POST"
        action="{{ route('password.email') }}"
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
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

        </div>

        <div style="margin-top:24px;">

            <x-primary-button
                style="width:100%;"
                :disabled="loading"
            >

                <span x-show="!loading">
                    Send Reset Link
                </span>

                <span x-show="loading">
                    Sending...
                </span>

            </x-primary-button>

        </div>

    </form>

</x-guest-layout>