@extends('layouts.app')

@section('content')

<div
    x-data="{
        deleteModal: false,
        deleteAction: '',
        categoryName: ''
    }"
>

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">

    <div>
        <h1 class="page-title" style="margin-bottom:6px;">
            Categories
        </h1>

        <p style="color:#6b7280;">
            Manage contract groups and classification types
        </p>
    </div>

    <a
        href="{{ route('categories.create') }}"
        class="btn btn-primary"
    >
        New Category
    </a>

</div>

@if($categories->count())

<div class="card" style="padding:0;overflow:hidden;">

    <table style="width:100%;border-collapse:collapse;">

        <thead>
            <tr style="background:#f9fafb;">
                <th style="padding:18px;text-align:left;">
                    Category
                </th>

                <th style="padding:18px;text-align:left;">
                    Contracts
                </th>

                <th style="padding:18px;text-align:right;">
                    Actions
                </th>
            </tr>
        </thead>

        <tbody>

        @foreach($categories as $category)

            <tr style="border-top:1px solid #e5e7eb;">

                <td style="padding:18px;font-weight:600;">
                    {{ $category->name }}
                </td>

                <td style="padding:18px;color:#6b7280;">
                    {{ $category->contracts_count }}
                </td>

                <td style="padding:18px;text-align:right;">

                    <button
                        type="button"
                        class="btn"
                        style="
                            background:#fee2e2;
                            color:#991b1b;
                        "
                        @click="
                            deleteModal = true;
                            deleteAction = '{{ route('categories.destroy', $category) }}';
                            categoryName = '{{ addslashes($category->name) }}';
                        "
                    >
                        Delete
                    </button>

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

<div style="margin-top:20px;">
    {{ $categories->links() }}
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
        folder
    </span>

    <h2 style="font-size:20px;margin-bottom:10px;">
        No categories yet
    </h2>

    <p style="color:#6b7280;margin-bottom:24px;">
        Create your first category to organize contracts.
    </p>

    <a
        href="{{ route('categories.create') }}"
        class="btn btn-primary"
    >
        Create Category
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
                Delete Category
            </h2>
        </div>

        <p style="color:#6b7280;line-height:1.7;margin-bottom:24px;">
            You are about to delete
            <strong x-text="categoryName"></strong>.
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
                :action="deleteAction"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="btn"
                    style="background:#dc2626;color:white;"
                >
                    Delete Category
                </button>
            </form>

        </div>
    </div>
</div>

</div>

@endsection