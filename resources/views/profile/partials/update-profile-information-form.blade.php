<section>

    <header style="margin-bottom:24px;">
        <h2 style="font-size:20px;font-weight:700;margin-bottom:6px;">
            Profile Information
        </h2>

        <p style="color:#6b7280;line-height:1.6;">
            Update your account name and email address.
        </p>
    </header>

    <form
        id="send-verification"
        method="POST"
        action="{{ route('verification.send') }}"
    >
        @csrf
    </form>

    <form
        method="POST"
        action="{{ route('profile.update') }}"
        x-data="{ loading:false }"
        @submit="loading=true"
    >
        @csrf
        @method('patch')

        <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:20px;">

            <div>
                <x-input-label
                    for="name"
                    value="Full Name"
                />

                <x-text-input
                    id="name"
                    name="name"
                    type="text"
                    :value="old('name', $user->name)"
                    required
                    autofocus
                    autocomplete="name"
                />

                <x-input-error
                    :messages="$errors->get('name')"
                />
            </div>

            <div>
                <x-input-label
                    for="email"
                    value="Email Address"
                />

                <x-text-input
                    id="email"
                    name="email"
                    type="email"
                    :value="old('email', $user->email)"
                    required
                    autocomplete="username"
                />

                <x-input-error
                    :messages="$errors->get('email')"
                />
            </div>

        </div>

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())

            <div
                style="
                    margin-top:20px;
                    padding:16px;
                    border-radius:14px;
                    background:#fef3c7;
                    color:#92400e;
                    line-height:1.6;
                "
            >
                Your email address is unverified.

                <button
                    form="send-verification"
                    style="
                        border:none;
                        background:none;
                        color:#92400e;
                        font-weight:700;
                        cursor:pointer;
                        text-decoration:underline;
                    "
                >
                    Resend verification email.
                </button>
            </div>

            @if (session('status') === 'verification-link-sent')

                <div
                    style="
                        margin-top:14px;
                        padding:14px 16px;
                        border-radius:14px;
                        background:#dcfce7;
                        color:#166534;
                    "
                >
                    A new verification link has been sent to your email address.
                </div>

            @endif

        @endif

        <div style="margin-top:24px;display:flex;align-items:center;gap:14px;">

            <button
                type="submit"
                class="btn btn-primary"
                x-bind:disabled="loading"
            >
                <span x-show="!loading">
                    Save Changes
                </span>

                <span x-show="loading">
                    Saving...
                </span>
            </button>

            @if (session('status') === 'profile-updated')

                <span
                    x-data="{ show:true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    style="color:#166534;font-size:14px;font-weight:600;"
                >
                    Saved.
                </span>

            @endif

        </div>

    </form>

</section>