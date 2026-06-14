@extends('layouts.app')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">

    <div>

        <h1 class="page-title" style="margin-bottom:8px;">
            {{ $contract->title }}
        </h1>

        @if($contract->status === 'active')

            <span style="
                background:#dcfce7;
                color:#166534;
                padding:8px 12px;
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
                padding:8px 12px;
                border-radius:999px;
                font-size:12px;
                font-weight:600;
            ">
                Expired
            </span>

        @else

            <span style="
                background:#fef3c7;
                color:#92400e;
                padding:8px 12px;
                border-radius:999px;
                font-size:12px;
                font-weight:600;
            ">
                Expiring
            </span>

        @endif

    </div>

    <div style="display:flex;gap:12px;">

        <a
            href="{{ route('contracts.edit', $contract) }}"
            class="btn"
            style="background:#f3f4f6;"
        >
            Edit
        </a>

    </div>

</div>

<div style="display:grid;grid-template-columns:repeat(2,1fr);gap:24px;">

    <div class="card">

        <h3 style="margin-bottom:20px;">
            Contract Details
        </h3>

        <p><strong>Counterparty:</strong> {{ $contract->counterparty }}</p>
        <br>

        <p><strong>Category:</strong> {{ $contract->category?->name ?? '-' }}</p>
        <br>

        <p><strong>Value:</strong>
            {{ $contract->value ? '$'.number_format($contract->value,2) : '-' }}
        </p>

    </div>

    <div class="card">

        <h3 style="margin-bottom:20px;">
            Important Dates
        </h3>

        <p>
            <strong>Start Date:</strong>
            {{ $contract->start_date?->format('M d, Y') ?? '-' }}
        </p>

        <br>

        <p>
            <strong>End Date:</strong>
            {{ $contract->end_date?->format('M d, Y') ?? '-' }}
        </p>

        <br>

        <p>
            <strong>Renewal Date:</strong>
            {{ $contract->renewal_date?->format('M d, Y') ?? '-' }}
        </p>

    </div>

</div>

@if($contract->description)

<div class="card" style="margin-top:24px;">

    <h3 style="margin-bottom:16px;">
        Description
    </h3>

    <p style="line-height:1.8;">
        {{ $contract->description }}
    </p>

</div>

@endif

@if($contract->document_path)

<div class="card" style="margin-top:24px;">

    <h3 style="margin-bottom:16px;">
        Document
    </h3>

    <a
        href="{{ asset('storage/'.$contract->document_path) }}"
        target="_blank"
        class="btn btn-primary"
    >
        Download Contract
    </a>

</div>

@endif

@endsection