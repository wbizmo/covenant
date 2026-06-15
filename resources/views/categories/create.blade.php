@extends('layouts.app')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:30px;">

    <div>
        <h1 class="page-title" style="margin-bottom:6px;">
            Create Category
        </h1>

        <p style="color:#6b7280;">
            Add a new contract classification type
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
    action="{{ route('categories.store') }}"
    x-data="{ loading:false }"
    @submit="loading=true"
>

    @csrf

    <div class="card" style="max-width:640px;">

        <div>
            <label>Category Name</label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                style="width:100%;padding:12px;border:1px solid #e5e7eb;border-radius:12px;margin-top:8px;"
                required
            >
        </div>

        <div style="margin-top:24px;display:flex;justify-content:flex-end;gap:12px;">

            <a
                href="{{ route('categories.index') }}"
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
                    Create Category
                </span>

                <span x-show="loading">
                    Saving...
                </span>
            </button>

        </div>

    </div>

</form>

@endsection