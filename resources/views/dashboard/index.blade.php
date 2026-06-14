@extends('layouts.app')

@section('content')

<h1 class="page-title">
    Dashboard
</h1>

<div
    style="
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:20px;
        margin-bottom:24px;
    "
>
    <div class="card">
        <div style="color:#6b7280;margin-bottom:8px;">
            Total Contracts
        </div>

        <div style="font-size:32px;font-weight:700;">
            {{ $totalContracts }}
        </div>
    </div>

    <div class="card">
        <div style="color:#6b7280;margin-bottom:8px;">
            Active
        </div>

        <div style="font-size:32px;font-weight:700;color:#166534;">
            {{ $activeContracts }}
        </div>
    </div>

    <div class="card">
        <div style="color:#6b7280;margin-bottom:8px;">
            Expiring
        </div>

        <div style="font-size:32px;font-weight:700;color:#92400e;">
            {{ $expiringContracts }}
        </div>
    </div>

    <div class="card">
        <div style="color:#6b7280;margin-bottom:8px;">
            Expired
        </div>

        <div style="font-size:32px;font-weight:700;color:#991b1b;">
            {{ $expiredContracts }}
        </div>
    </div>
</div>

<div
    style="
        display:grid;
        grid-template-columns:2fr 1fr;
        gap:24px;
    "
>
    <div class="card">

        <div
            style="
                display:flex;
                justify-content:space-between;
                align-items:center;
                margin-bottom:20px;
            "
        >
            <h3>
                Recent Contracts
            </h3>

            <a href="{{ route('contracts.index') }}">
                View All
            </a>
        </div>

        @forelse($recentContracts as $contract)

            <div
                style="
                    display:flex;
                    justify-content:space-between;
                    padding:14px 0;
                    border-bottom:1px solid #f1f5f9;
                "
            >
                <div>
                    <a
                        href="{{ route('contracts.show', $contract) }}"
                        style="
                            font-weight:600;
                            color:#111827;
                        "
                    >
                        {{ $contract->title }}
                    </a>

                    <div
                        style="
                            font-size:13px;
                            color:#6b7280;
                            margin-top:4px;
                        "
                    >
                        {{ $contract->counterparty }}
                    </div>
                </div>

                <div
                    style="
                        font-size:13px;
                        color:#6b7280;
                    "
                >
                    {{ $contract->created_at->diffForHumans() }}
                </div>
            </div>

        @empty

            <p style="color:#6b7280;">
                No contracts yet.
            </p>

        @endforelse

    </div>

    <div class="card">

        <h3 style="margin-bottom:20px;">
            Contract Health
        </h3>

        <div style="display:flex;flex-direction:column;gap:16px;">

            <div>
                <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
                    <span style="font-size:14px;color:#374151;">
                        Active
                    </span>

                    <strong>
                        {{ $activeContracts }}
                    </strong>
                </div>

                <div style="height:10px;background:#f3f4f6;border-radius:999px;overflow:hidden;">
                    <div
                        style="
                            height:100%;
                            width:{{ $totalContracts ? ($activeContracts / $totalContracts) * 100 : 0 }}%;
                            background:#22c55e;
                            border-radius:999px;
                        "
                    ></div>
                </div>
            </div>

            <div>
                <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
                    <span style="font-size:14px;color:#374151;">
                        Expiring
                    </span>

                    <strong>
                        {{ $expiringContracts }}
                    </strong>
                </div>

                <div style="height:10px;background:#f3f4f6;border-radius:999px;overflow:hidden;">
                    <div
                        style="
                            height:100%;
                            width:{{ $totalContracts ? ($expiringContracts / $totalContracts) * 100 : 0 }}%;
                            background:#f59e0b;
                            border-radius:999px;
                        "
                    ></div>
                </div>
            </div>

            <div>
                <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
                    <span style="font-size:14px;color:#374151;">
                        Expired
                    </span>

                    <strong>
                        {{ $expiredContracts }}
                    </strong>
                </div>

                <div style="height:10px;background:#f3f4f6;border-radius:999px;overflow:hidden;">
                    <div
                        style="
                            height:100%;
                            width:{{ $totalContracts ? ($expiredContracts / $totalContracts) * 100 : 0 }}%;
                            background:#ef4444;
                            border-radius:999px;
                        "
                    ></div>
                </div>
            </div>

        </div>

    </div>
</div>

<div
    style="
        display:grid;
        grid-template-columns:1fr;
        gap:24px;
        margin-top:24px;
    "
>
    <div class="card">

        <h3 style="margin-bottom:20px;">
            Upcoming Renewals
        </h3>

        @forelse($upcomingRenewals as $contract)

            <div
                style="
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    padding:14px 0;
                    border-bottom:1px solid #f1f5f9;
                "
            >
                <div>
                    <a
                        href="{{ route('contracts.show', $contract) }}"
                        style="
                            font-weight:600;
                            color:#111827;
                        "
                    >
                        {{ $contract->title }}
                    </a>

                    <div
                        style="
                            font-size:13px;
                            color:#6b7280;
                            margin-top:4px;
                        "
                    >
                        {{ $contract->counterparty }}
                    </div>
                </div>

                <span
                    style="
                        background:#eef2ff;
                        color:#3730a3;
                        padding:7px 11px;
                        border-radius:999px;
                        font-size:12px;
                        font-weight:600;
                    "
                >
                    {{ $contract->renewal_countdown }}
                </span>
            </div>

        @empty

            <p style="color:#6b7280;">
                No upcoming renewals.
            </p>

        @endforelse

    </div>
</div>

@endsection