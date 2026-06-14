<x-guest-layout>

    <div style="margin-bottom:28px;">

        <h1 style="
            font-size:28px;
            font-weight:700;
            margin-bottom:8px;
        ">
            Verify Email
        </h1>

        <p style="
            color:#6b7280;
            line-height:1.6;
        ">
            Check your inbox and click the verification link we sent.
        </p>

    </div>

    @if (session('status') == 'verification-link-sent')

        <div style="
            background:#dcfce7;
            color:#166534;
            padding:16px;
            border-radius:12px;
            margin-bottom:20px;
        ">
            Verification email sent successfully.
        </div>

    @endif

    <form method="POST" action="{{ route('verification.send') }}">

        @csrf

        <x-primary-button style="width:100%;">
            Resend Verification Email
        </x-primary-button>

    </form>

    <form
        method="POST"
        action="{{ route('logout') }}"
        style="margin-top:16px;"
    >

        @csrf

        <button
            type="submit"
            style="
                width:100%;
                padding:12px;
                border-radius:12px;
                border:1px solid #e5e7eb;
                background:#fff;
                cursor:pointer;
            "
        >
            Log Out
        </button>

    </form>

</x-guest-layout>