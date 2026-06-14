<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covenant</title>

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

        .layout{
            display:flex;
            min-height:100vh;
        }

        .sidebar{
            width:260px;
            background:#fff;
            border-right:1px solid #e5e7eb;
            position:fixed;
            top:0;
            bottom:0;
            left:0;
        }

        .main{
            flex:1;
            margin-left:260px;
        }

        .topbar{
            height:70px;
            background:#fff;
            border-bottom:1px solid #e5e7eb;
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:0 24px;
        }

        .content{
            padding:32px;
        }

        .logo{
            padding:24px;
            font-size:22px;
            font-weight:700;
            border-bottom:1px solid #e5e7eb;
        }

        .nav{
            padding:16px;
        }

        .nav a{
            display:flex;
            align-items:center;
            gap:12px;
            padding:12px 14px;
            border-radius:12px;
            margin-bottom:6px;
            color:#4b5563;
            font-size:14px;
            font-weight:500;
        }

        .nav a:hover{
            background:#f3f4f6;
        }

        .card{
            background:#fff;
            border:1px solid #e5e7eb;
            border-radius:18px;
            padding:24px;
        }

        .btn{
            border:none;
            cursor:pointer;
            border-radius:12px;
            padding:12px 18px;
            font-weight:600;
        }

        .btn-primary{
            background:#111827;
            color:#fff;
        }

        .page-title{
            font-size:30px;
            font-weight:700;
            margin-bottom:24px;
        }
    </style>
</head>
<body>

<div class="layout">

    <aside class="sidebar">

        <div class="logo">
            Covenant
        </div>

        <nav class="nav">

            <a href="{{ route('dashboard') }}">
                <span class="material-symbols-rounded">dashboard</span>
                Dashboard
            </a>

            <a href="{{ route('contracts.index') }}">
                <span class="material-symbols-rounded">description</span>
                Contracts
            </a>

            <a href="{{ route('contracts.create') }}">
                <span class="material-symbols-rounded">add_circle</span>
                New Contract
            </a>

            <a href="{{ route('categories.index') }}">
                <span class="material-symbols-rounded">folder</span>
                Categories
            </a>

            <a href="{{ route('profile.edit') }}">
                <span class="material-symbols-rounded">settings</span>
                Settings
            </a>

        </nav>

    </aside>

    <main class="main">

        <div class="topbar">

            <div>
                Contract Lifecycle Management
            </div>

            <div>
                {{ auth()->user()->name }}
            </div>

        </div>

        <div class="content">

            @yield('content')

        </div>

    </main>

</div>

</body>
</html>