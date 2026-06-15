@extends('layouts.app')

@section('content')

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

                    <form
                        method="POST"
                        action="{{ route('categories.destroy', $category) }}"
                        onsubmit="return confirm('Delete this category?')"
                        style="display:inline;"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn"
                            style="
                                background:#fee2e2;
                                color:#991b1b;
                            "
                        >
                            Delete
                        </button>

                    </form>

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

@endsection