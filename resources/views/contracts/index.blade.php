@extends('layouts.app')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">

    <div>
        <h1 class="page-title" style="margin-bottom:6px;">
            Contracts
        </h1>

        <p style="color:#6b7280;">
            Manage agreements and renewals
        </p>
    </div>

    <a
        href="{{ route('contracts.create') }}"
        class="btn btn-primary"
    >
        New Contract
    </a>

</div>

@if($contracts->count())

<div class="card" style="padding:0;overflow:hidden;">

    <table style="width:100%;border-collapse:collapse;">

        <thead>

            <tr style="background:#f9fafb;">

                <th style="padding:18px;text-align:left;">
                    Contract
                </th>

                <th style="padding:18px;text-align:left;">
                    Category
                </th>

                <th style="padding:18px;text-align:left;">
                    Counterparty
                </th>

                <th style="padding:18px;text-align:left;">
                    Value
                </th>

                <th style="padding:18px;text-align:left;">
                    End Date
                </th>

                <th style="padding:18px;text-align:left;">
                    Status
                </th>

            </tr>

        </thead>

        <tbody>

        @foreach($contracts as $contract)

            <tr style="border-top:1px solid #e5e7eb;">

                <td style="padding:18px;">

                    <div style="font-weight:600;">
                        {{ $contract->title }}
                    </div>

                    <div style="font-size:13px;color:#6b7280;">
                        Created {{ $contract->created_at->diffForHumans() }}
                    </div>

                </td>

                <td style="padding:18px;">
                    {{ $contract->category?->name ?? '-' }}
                </td>

                <td style="padding:18px;">
                    {{ $contract->counterparty }}
                </td>

                <td style="padding:18px;">
                    {{ $contract->value ? '$'.number_format($contract->value,2) : '-' }}
                </td>

                <td style="padding:18px;">
                    {{ $contract->end_date?->format('M d, Y') ?? '-' }}
                </td>

                <td style="padding:18px;">

                    @if($contract->status === 'active')

                        <span style="
                            background:#dcfce7;
                            color:#166534;
                            padding:6px 10px;
                            border-radius:999px;
                            font-size:12px;
                            font-weight:600;
                        ">
                            Active
                        </span>

                    @elseif($contract->status === 'expired')

                        <span style="
                            background:#fee2e2;
                            color:#991b1b;
                            padding:6px 10px;
                            border-radius:999px;
                            font-size:12px;
                            font-weight:600;
                        ">
                            Expired
                        </span>

                    @elseif($contract->status === 'expiring')

                        <span style="
                            background:#fef3c7;
                            color:#92400e;
                            padding:6px 10px;
                            border-radius:999px;
                            font-size:12px;
                            font-weight:600;
                        ">
                            Expiring
                        </span>

                    @else

                        <span style="
                            background:#e5e7eb;
                            color:#374151;
                            padding:6px 10px;
                            border-radius:999px;
                            font-size:12px;
                            font-weight:600;
                        ">
                            Draft
                        </span>

                    @endif

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

<div style="margin-top:20px;">
    {{ $contracts->links() }}
</div>

@else

<div
    class="card"
    style="
        text-align:center;
        padding:80px 20px;
    "
>

    <span
        class="material-symbols-rounded"
        style="
            font-size:72px;
            color:#d1d5db;
            display:block;
            margin-bottom:16px;
        "
    >
        description
    </span>

    <h2
        style="
            font-size:20px;
            margin-bottom:10px;
        "
    >
        No contracts yet
    </h2>

    <p
        style="
            color:#6b7280;
            margin-bottom:24px;
        "
    >
        Create your first contract to get started.
    </p>

    <a
        href="{{ route('contracts.create') }}"
        class="btn btn-primary"
    >
        Create Contract
    </a>

</div>

@endif

@endsection