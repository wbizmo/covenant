@extends('layouts.app')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">

    <div>
        <h1 class="page-title" style="margin-bottom:6px;">
            Contracts
        </h1>

        <p style="color:#6b7280;">
            Manage agreements, renewals and contract documents
        </p>
    </div>

    <a
        href="{{ route('contracts.create') }}"
        class="btn btn-primary"
    >
        New Contract
    </a>

</div>

<div class="card" style="margin-bottom:20px;">

    <form
        method="GET"
        action="{{ route('contracts.index') }}"
        style="
            display:grid;
            grid-template-columns:2fr 1fr 1fr auto auto;
            gap:14px;
            align-items:end;
        "
    >

        <div>
            <label style="font-size:13px;font-weight:600;color:#374151;">
                Search
            </label>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search title, counterparty or description"
                style="
                    width:100%;
                    margin-top:8px;
                    padding:12px 14px;
                    border:1px solid #e5e7eb;
                    border-radius:12px;
                "
            >
        </div>

        <div>
            <label style="font-size:13px;font-weight:600;color:#374151;">
                Category
            </label>

            <select
                name="category_id"
                style="
                    width:100%;
                    margin-top:8px;
                    padding:12px 14px;
                    border:1px solid #e5e7eb;
                    border-radius:12px;
                    background:#ffffff;
                "
            >
                <option value="">
                    All Categories
                </option>

                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        @selected(request('category_id') == $category->id)
                    >
                        {{ $category->name }}
                    </option>

                @endforeach

            </select>
        </div>

        <div>
            <label style="font-size:13px;font-weight:600;color:#374151;">
                Status
            </label>

            <select
                name="status"
                style="
                    width:100%;
                    margin-top:8px;
                    padding:12px 14px;
                    border:1px solid #e5e7eb;
                    border-radius:12px;
                    background:#ffffff;
                "
            >
                <option value="">
                    All Statuses
                </option>

                <option
                    value="active"
                    @selected(request('status') === 'active')
                >
                    Active
                </option>

                <option
                    value="expiring"
                    @selected(request('status') === 'expiring')
                >
                    Expiring
                </option>

                <option
                    value="expired"
                    @selected(request('status') === 'expired')
                >
                    Expired
                </option>
            </select>
        </div>

        <button
            type="submit"
            class="btn btn-primary"
        >
            Filter
        </button>

        <a
            href="{{ route('contracts.index') }}"
            class="btn"
            style="
                background:#f3f4f6;
                color:#111827;
                text-align:center;
            "
        >
            Reset
        </a>

    </form>

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

                    <a
                        href="{{ route('contracts.show', $contract) }}"
                        style="
                            font-weight:600;
                            color:#111827;
                        "
                    >
                        {{ $contract->title }}
                    </a>

                    <div style="font-size:13px;color:#6b7280;">
                        {{ $contract->counterparty }}
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

                    @if($contract->calculated_status === 'active')

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

                    @elseif($contract->calculated_status === 'expired')

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

                    @elseif($contract->calculated_status === 'expiring')

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
        search_off
    </span>

    <h2
        style="
            font-size:20px;
            margin-bottom:10px;
        "
    >
        No contracts found
    </h2>

    <p
        style="
            color:#6b7280;
            margin-bottom:24px;
        "
    >
        Try changing your search or filter options.
    </p>

    <a
        href="{{ route('contracts.index') }}"
        class="btn btn-primary"
    >
        Reset Filters
    </a>

</div>

@endif

@endsection