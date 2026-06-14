<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Covenant</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Inter',sans-serif;
        }

        body{
            background:#f7f8fa;
            color:#111827;
        }

        a{
            text-decoration:none;
            color:inherit;
        }

        .auth-layout{
            min-height:100vh;
            display:grid;
            grid-template-columns:1fr 520px;
        }

        .auth-brand{
            background:#ffffff;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:60px;
            border-right:1px solid #e5e7eb;
        }

        .auth-brand-inner{
            max-width:520px;
        }

        .logo{
            font-size:32px;
            font-weight:800;
            margin-bottom:24px;
        }

        .hero-title{
            font-size:52px;
            line-height:1.1;
            font-weight:800;
            margin-bottom:20px;
        }

        .hero-text{
            color:#6b7280;
            line-height:1.8;
            font-size:16px;
        }

        .auth-panel{
            display:flex;
            align-items:center;
            justify-content:center;
            padding:40px;
        }

        .auth-card{
            width:100%;
            max-width:420px;
            background:#fff;
            border:1px solid #e5e7eb;
            border-radius:24px;
            padding:32px;
        }

        .auth-card h1{
            font-size:28px;
            margin-bottom:8px;
        }

        .auth-card p{
            color:#6b7280;
            margin-bottom:24px;
        }

        @media(max-width:900px){

            .auth-layout{
                grid-template-columns:1fr;
            }

            .auth-brand{
                display:none;
            }

        }

    </style>

</head>
<body>

<div class="auth-layout">

    <div class="auth-brand">

        <div class="auth-brand-inner">

            <div class="logo">
                Covenant
            </div>

            <h1 class="hero-title">
                Contract Lifecycle Management
            </h1>

            <p class="hero-text">
                Centralize contracts, monitor renewals, track obligations,
                manage counterparties and maintain visibility across every
                agreement in one secure workspace.
            </p>

        </div>

    </div>

    <div class="auth-panel">

        <div class="auth-card">

            {{ $slot }}

        </div>

    </div>

</div>

</body>
</html>