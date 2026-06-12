<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Smart Health System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0f4c75;
            --secondary: #1b6ca8;
            --accent: #00d4aa;
            --dark: #0a2540;
        }
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Nunito',sans-serif; }

        .top-nav {
            background: rgba(10,37,64,0.97); padding:15px 0; position:sticky; top:0; z-index:1000;
            box-shadow:0 2px 20px rgba(0,0,0,0.3);
        }
        .top-nav .brand {
            font-family:'Playfair Display',serif; font-size:1.6rem; color:#fff; text-decoration:none;
        }
        .top-nav .brand span { color: var(--accent); }
        .top-nav .nav-link { color:rgba(255,255,255,0.85); font-weight:600; text-decoration:none; margin-left:10px; }
        .top-nav .nav-link:hover { color: var(--accent); }
        .top-nav .btn-register {
            background: var(--accent); color:#fff; border-radius:25px; padding:8px 22px;
            text-decoration:none; font-weight:700; margin-left:10px;
        }
        .top-nav .btn-register:hover { background:#00b891; }
    </style>
    @stack('styles')
</head>
<body>

<nav class="top-nav">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="{{ route('home') }}" class="brand">
            <i class="fas fa-heartbeat me-2"></i>Smart<span>Health</span>
        </a>
        <div>
            <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home me-1"></i>Home</a>
            @if(request()->routeIs('login'))
                <a href="{{ route('register') }}" class="btn-register">Register</a>
            @else
                <a href="{{ route('login') }}" class="nav-link">Login</a>
            @endif
        </div>
    </div>
</nav>

@yield('content')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>