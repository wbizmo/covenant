@extends('layouts.app')

@section('content')

<div x-data="{ deleteModal:false }">

<div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:24px;">

    <div>
        <h1 class="page-title" style="margin-bottom:8px;">
            {{ $contract->title }}
        </h1>

        @if($contract->calculated_status === 'active')
            <span style="background:#dcfce7;color:#166534;padding:8px 12px;border-radius:999px;font-size:12px;font-weight:600;">
                Active
            </span>
        @elseif($contract->calculated_status === 'expired')
            <span style="background:#fee2e2;color:#991b1b;padding:8px 12px;border-radius:999px;font-size:12px;font-weight:600;">
                Expired
            </span>
        @elseif($contract->calculated_status === 'expiring')
            <span style="background:#fef3c7;color:#92400e;padding:8px 12px;border-radius:999px;font-size:12px;font-weight:600;">
                Expiring
            </span>
        @else
            <span style="background:#e5e7eb;color:#374151;padding:8px 12px;border-radius:999px;font-size:12px;font-weight:600;">
                Draft
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

        <button
            type="button"
            class="btn"
            style="background:#dc2626;color:white;"
            @click="deleteModal = true"
        >
            Delete
        </button>

    </div>

</div>

<div style="display:grid;grid-template-columns:repeat(2,1fr);gap:24px;">

    <div class="card">
        <h3 style="margin-bottom:20px;">
            Contract Details
        </h3>

        <p>
            <strong>Counterparty:</strong>
            {{ $contract->counterparty }}
        </p>

        <br>

        <p>
            <strong>Category:</strong>
            {{ $contract->category?->name ?? '-' }}
        </p>

        <br>

        <p>
            <strong>Value:</strong>
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
        Attached Document
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

<div
    x-show="deleteModal"
    x-transition
    style="
        position:fixed;
        inset:0;
        background:rgba(17,24,39,.45);
        display:flex;
        align-items:center;
        justify-content:center;
        z-index:9999;
    "
>
    <div
        style="
            width:100%;
            max-width:420px;
            background:#fff;
            border-radius:20px;
            padding:28px;
            box-shadow:0 25px 60px rgba(0,0,0,.25);
        "
        @click.outside="deleteModal = false"
    >
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
            <span
                class="material-symbols-rounded"
                style="color:#dc2626;font-size:32px;"
            >
                warning
            </span>

            <h2 style="font-size:20px;">
                Delete Contract
            </h2>
        </div>

        <p style="color:#6b7280;line-height:1.7;margin-bottom:24px;">
            This will permanently delete this contract and its attached document.
            This action cannot be undone.
        </p>

        <div style="display:flex;justify-content:flex-end;gap:12px;">
            <button
                type="button"
                class="btn"
                style="background:#f3f4f6;"
                @click="deleteModal = false"
            >
                Cancel
            </button>

            <form
                method="POST"
                action="{{ route('contracts.destroy', $contract) }}"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn"
                    style="background:#dc2626;color:white;"
                >
                    Delete Contract
                </button>
            </form>
        </div>
    </div>
</div>

</div>

@endsection