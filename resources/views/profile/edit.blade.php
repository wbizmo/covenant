@extends('layouts.app')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">

    <div>
        <h1 class="page-title" style="margin-bottom:6px;">
            Settings
        </h1>

        <p style="color:#6b7280;">
            Manage your account profile, password and security preferences.
        </p>
    </div>

</div>

<div style="display:grid;grid-template-columns:1fr;gap:24px;max-width:900px;">

    <div class="card">
        @include('profile.partials.update-profile-information-form')
    </div>

    <div class="card">
        @include('profile.partials.update-password-form')
    </div>

    <div class="card" style="border-color:#fecaca;">
        @include('profile.partials.delete-user-form')
    </div>

</div>

@endsection