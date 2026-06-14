@extends('layouts.app')

@section('content')

<h1 class="page-title">
    Dashboard
</h1>

<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:20px;">

    <div class="card">
        <small>Total Contracts</small>
        <h2>{{ $totalContracts }}</h2>
    </div>

    <div class="card">
        <small>Active</small>
        <h2>{{ $activeContracts }}</h2>
    </div>

    <div class="card">
        <small>Expiring</small>
        <h2>{{ $expiringContracts }}</h2>
    </div>

    <div class="card">
        <small>Expired</small>
        <h2>{{ $expiredContracts }}</h2>
    </div>

</div>

@endsection