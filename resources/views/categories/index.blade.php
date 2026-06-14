@extends('layouts.app')

@section('content')

<h1 class="page-title">
    Categories
</h1>

<div class="card">

    @foreach($categories as $category)

        <p style="margin-bottom:12px;">
            {{ $category->name }}
            ({{ $category->contracts_count }})
        </p>

    @endforeach

</div>

@endsection