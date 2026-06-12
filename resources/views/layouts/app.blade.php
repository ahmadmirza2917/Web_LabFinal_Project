<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Health System - @yield('title', 'Healthcare Platform')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0f4c75;
            --secondary: #1b6ca8;
            --accent: #00d4aa;
            --light-bg: #f0f8ff;
            --dark: #0a2540;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Nunito', sans-serif; background: #fff; }

        /* NAVBAR */
        .navbar { background: rgba(10,37,64,0.97); backdrop-filter: blur(10px); padding: 15px 0; position: sticky; top: 0; z-index: 1000; box-shadow: 0 2px 20px rgba(0,0,0,0.3); }
        .navbar-brand { font-family: 'Playfair Display', serif; font-size: 1.6rem; color: #fff !important; }
        .navbar-brand span { color: var(--accent); }
        .nav-link { color: rgba(255,255,255,0.85) !important; font-weight: 600; margin: 0 5px; transition: all 0.3s; }
        .nav-link:hover { color: var(--accent) !important; }
        .btn-login { background: var(--accent); color: #fff !important; border-radius: 25px; padding: 8px 22px !important; }
        .btn-login:hover { background: #00b891; transform: translateY(-2px); }

        /* ANIMATIONS */
        @keyframes fadeInUp { from { opacity:0; transform:translateY(30px); } to { opacity:1; transform:translateY(0); } }
        @keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-15px)} }
        @keyframes pulse { 0%,100%{box-shadow:0 0 0 0 rgba(0,212,170,0.4)} 70%{box-shadow:0 0 0 20px rgba(0,212,170,0)} }

        .animate-fade { animation: fadeInUp 0.7s ease both; }
        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }

        footer { background: var(--dark); color: rgba(255,255,255,0.7); padding: 40px 0 20px; }
        footer h5 { color: var(--accent); }
        footer a { color: rgba(255,255,255,0.7); text-decoration: none; }
        footer a:hover { color: var(--accent); }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-heartbeat me-2"></i>Smart<span>Health</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('doctors') }}">Doctors</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                    @guest
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link btn-login ms-2" href="{{ route('register') }}">Register</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i>{{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if(auth()->user()->role === 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                @elseif(auth()->user()->role === 'doctor')
                                    <li><a class="dropdown-item" href="{{ route('doctor.dashboard') }}">Dashboard</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('patient.dashboard') }}">Dashboard</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5><i class="fas fa-heartbeat me-2"></i>SmartHealth</h5>
                    <p class="mt-2">Your trusted digital healthcare partner. AI-powered, doctor-approved.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled mt-2">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('doctors') }}">Our Doctors</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Contact</h5>
                    <p class="mt-2"><i class="fas fa-phone me-2"></i>+92 300 1234567</p>
                    <p><i class="fas fa-envelope me-2"></i>info@smarthealth.com</p>
                </div>
            </div>
            <hr style="border-color:rgba(255,255,255,0.2)">
            <p class="text-center mb-0">© {{ date('Y') }} Smart Health System. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>