@extends('layouts.app')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:30px;">
    <div>
        <h1 class="page-title" style="margin-bottom:6px;">
            Edit Contract
        </h1>

        <p style="color:#6b7280;">
            Update contract information and attached documents
        </p>
    </div>
</div>

@if ($errors->any())

<div class="card" style="border-color:#fecaca;background:#fef2f2;margin-bottom:20px;">
    <ul>
        @foreach ($errors->all() as $error)
            <li style="margin-bottom:8px;">
                {{ $error }}
            </li>
        @endforeach
    </ul>
</div>

@endif

<form
    method="POST"
    action="{{ route('contracts.update', $contract) }}"
    enctype="multipart/form-data"
    x-data="{ loading:false }"
    @submit="loading=true"
>

    @csrf
    @method('PUT')

    <div class="card">

        <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:20px;">

            <div>
                <label>Contract Title</label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title', $contract->title) }}"
                    style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
                    required
                >
            </div>

            <div>
                <label>Counterparty</label>

                <input
                    type="text"
                    name="counterparty"
                    value="{{ old('counterparty', $contract->counterparty) }}"
                    style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
                    required
                >
            </div>

            <div>
                <label>Category</label>

                <select
                    name="category_id"
                    style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
                >

                    <option value="">
                        Select Category
                    </option>

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            @selected(old('category_id', $contract->category_id) == $category->id)
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>
            </div>

            <div>
                <label>Contract Value</label>

                <input
                    type="number"
                    name="value"
                    value="{{ old('value', $contract->value) }}"
                    style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
                >
            </div>

            <div>
                <label>Start Date</label>

                <input
                    type="date"
                    name="start_date"
                    value="{{ old('start_date', optional($contract->start_date)->format('Y-m-d')) }}"
                    style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
                >
            </div>

            <div>
                <label>End Date</label>

                <input
                    type="date"
                    name="end_date"
                    value="{{ old('end_date', optional($contract->end_date)->format('Y-m-d')) }}"
                    style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
                >
            </div>

            <div>
                <label>Renewal Date</label>

                <input
                    type="date"
                    name="renewal_date"
                    value="{{ old('renewal_date', optional($contract->renewal_date)->format('Y-m-d')) }}"
                    style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
                >
            </div>

            <div>
                <label>Replace Contract File</label>

                <input
                    type="file"
                    name="document"
                    style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
                >

                @if($contract->document_path)

                    <div style="margin-top:10px;font-size:13px;color:#6b7280;">
                        Existing file attached
                    </div>

                @endif

            </div>

        </div>

        <div style="margin-top:20px;">

            <label>Description</label>

            <textarea
                name="description"
                rows="5"
                style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
            >{{ old('description', $contract->description) }}</textarea>

        </div>

        <div style="margin-top:24px;display:flex;justify-content:flex-end;gap:12px;">

            <a
                href="{{ route('contracts.show', $contract) }}"
                class="btn"
                style="background:#f3f4f6;"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="btn btn-primary"
                x-bind:disabled="loading"
            >

                <span x-show="!loading">
                    Update Contract
                </span>

                <span x-show="loading">
                    Updating...
                </span>

            </button>

        </div>

    </div>

</form>

@endsection