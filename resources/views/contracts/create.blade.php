@extends('layouts.app')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:30px;">
    <div>
        <h1 class="page-title" style="margin-bottom:6px;">
            Create Contract
        </h1>

        <p style="color:#6b7280;">
            Add a new agreement to Covenant
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
    action="{{ route('contracts.store') }}"
    enctype="multipart/form-data"
    x-data="{ loading:false }"
    @submit="loading=true"
>

    @csrf

    <div class="card">

        <div style="display:grid;grid-template-columns:repeat(2,1fr);gap:20px;">

            <div>
                <label>Contract Title</label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
                    required
                >
            </div>

            <div>
                <label>Counterparty</label>

                <input
                    type="text"
                    name="counterparty"
                    value="{{ old('counterparty') }}"
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

                        <option value="{{ $category->id }}">
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
                    value="{{ old('value') }}"
                    style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
                >
            </div>

            <div>
                <label>Start Date</label>

                <input
                    type="date"
                    name="start_date"
                    style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
                >
            </div>

            <div>
                <label>End Date</label>

                <input
                    type="date"
                    name="end_date"
                    style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
                >
            </div>

            <div>
                <label>Renewal Date</label>

                <input
                    type="date"
                    name="renewal_date"
                    style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
                >
            </div>

            <div>
                <label>Contract File</label>

                <input
                    type="file"
                    name="document"
                    style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
                >
            </div>

        </div>

        <div style="margin-top:20px;">

            <label>Description</label>

            <textarea
                name="description"
                rows="5"
                style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
            >{{ old('description') }}</textarea>

        </div>

        <div style="margin-top:24px;display:flex;justify-content:flex-end;">

            <button
                type="submit"
                class="btn btn-primary"
                x-bind:disabled="loading"
            >

                <span x-show="!loading">
                    Save Contract
                </span>

                <span x-show="loading">
                    Saving...
                </span>

            </button>

        </div>

    </div>

</form>

@endsection