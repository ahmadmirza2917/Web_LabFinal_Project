<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Smart Health System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0f4c75;
            --secondary: #1b6ca8;
            --accent: #00d4aa;
            --sidebar-width: 260px;
            --sidebar-bg: #0a2540;
        }
        body { font-family:'Nunito',sans-serif; background:#f0f4f8; }

        /* SIDEBAR */
        .sidebar {
            position: fixed; top:0; left:0; height:100vh; width:var(--sidebar-width);
            background: linear-gradient(180deg, #0a2540 0%, #0f4c75 100%);
            overflow-y: auto; z-index:1000; transition: transform 0.3s;
            box-shadow: 4px 0 20px rgba(0,0,0,0.3);
        }
        .sidebar-brand {
            padding: 25px 20px; border-bottom: 1px solid rgba(255,255,255,0.1);
            font-family:'Playfair Display',serif; color:#fff; font-size:1.3rem;
        }
        .sidebar-brand span { color: var(--accent); }
        .sidebar-brand .role-badge {
            display:block; font-family:'Nunito',sans-serif; font-size:0.7rem;
            background:var(--accent); color:#fff; padding:2px 10px; border-radius:20px;
            width:fit-content; margin-top:5px; font-weight:700; letter-spacing:1px;
        }
        .sidebar-nav { padding: 15px 0; }
        .sidebar-nav .nav-item { margin: 3px 10px; }
        .sidebar-nav .nav-link {
            color: rgba(255,255,255,0.75); border-radius:10px; padding:12px 16px;
            font-weight:600; transition:all 0.3s; display:flex; align-items:center; gap:12px;
        }
        .sidebar-nav .nav-link:hover, .sidebar-nav .nav-link.active {
            background: rgba(0,212,170,0.2); color: var(--accent);
        }
        .sidebar-nav .nav-link i { width:20px; text-align:center; }
        .sidebar-divider { border-color:rgba(255,255,255,0.1); margin:10px 15px; }

        /* MAIN CONTENT */
        .main-content { margin-left:var(--sidebar-width); min-height:100vh; }

        /* TOPBAR */
        .topbar {
            background:#fff; padding:15px 25px; display:flex; align-items:center;
            justify-content:space-between; box-shadow:0 2px 10px rgba(0,0,0,0.08);
            position:sticky; top:0; z-index:100;
        }
        .topbar-title { font-size:1.3rem; font-weight:800; color:var(--primary); }
        .user-info { display:flex; align-items:center; gap:12px; }
        .user-avatar {
            width:40px; height:40px; background:var(--accent); border-radius:50%;
            display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700;
        }

        /* CARDS */
        .stat-card {
            background:#fff; border-radius:16px; padding:25px; border:none;
            box-shadow:0 4px 20px rgba(0,0,0,0.06); transition:all 0.3s;
            position:relative; overflow:hidden;
        }
        .stat-card:hover { transform:translateY(-5px); box-shadow:0 8px 30px rgba(0,0,0,0.12); }
        .stat-card .stat-icon {
            width:60px; height:60px; border-radius:15px; display:flex;
            align-items:center; justify-content:center; font-size:1.5rem; color:#fff;
            position:absolute; right:20px; top:20px;
        }
        .stat-card .stat-number { font-size:2.2rem; font-weight:800; color:var(--primary); }
        .stat-card .stat-label { color:#6c757d; font-weight:600; margin-top:5px; }

        /* CONTENT CARD */
        .content-card {
            background:#fff; border-radius:16px; padding:25px;
            box-shadow:0 4px 20px rgba(0,0,0,0.06); margin-bottom:25px;
        }
        .content-card-header {
            display:flex; align-items:center; justify-content:space-between;
            margin-bottom:20px; padding-bottom:15px; border-bottom:2px solid #f0f4f8;
        }
        .content-card-header h5 { font-weight:800; color:var(--primary); margin:0; }

        /* BADGES */
        .badge-pending { background:#fff3cd; color:#856404; }
        .badge-approved { background:#d1edff; color:#0f4c75; }
        .badge-rejected { background:#f8d7da; color:#842029; }
        .badge-completed { background:#d1e7dd; color:#0a3622; }

        /* TABLE */
        .table { border-radius:10px; overflow:hidden; }
        .table thead th { background:var(--primary); color:#fff; border:none; font-weight:700; }
        .table tbody tr:hover { background:#f0f8ff; }

        /* ANIMATIONS */
        @keyframes fadeIn { from{opacity:0;transform:translateY(20px)} to{opacity:1;transform:translateY(0)} }
        .fade-in { animation:fadeIn 0.5s ease both; }
        .delay-1{animation-delay:0.1s} .delay-2{animation-delay:0.2s} .delay-3{animation-delay:0.3s} .delay-4{animation-delay:0.4s}

        /* ALERTS */
        .alert { border-radius:12px; border:none; }

        /* FORMS */
        .form-control, .form-select {
            border-radius:10px; border:2px solid #e9ecef; padding:10px 15px;
            font-family:'Nunito',sans-serif; transition:all 0.3s;
        }
        .form-control:focus, .form-select:focus {
            border-color:var(--accent); box-shadow:0 0 0 3px rgba(0,212,170,0.15);
        }
        .btn-primary { background:var(--primary); border:none; border-radius:10px; font-weight:700; }
        .btn-primary:hover { background:var(--secondary); }
        .btn-success { background:var(--accent); border:none; border-radius:10px; font-weight:700; color:#fff; }
        .btn-success:hover { background:#00b891; }

        @media(max-width:768px) {
            .sidebar { transform:translateX(-100%); }
            .sidebar.show { transform:translateX(0); }
            .main-content { margin-left:0; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <i class="fas fa-heartbeat me-2" style="color:var(--accent)"></i>SmartHealth
        <span class="role-badge">{{ strtoupper(auth()->user()->role) }}</span>
    </div>
    <nav class="sidebar-nav">
        @if(auth()->user()->role === 'admin')
            <div class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i> Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.doctors.index') }}" class="nav-link {{ request()->routeIs('admin.doctors*') ? 'active' : '' }}">
                    <i class="fas fa-user-md"></i> Manage Doctors
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.patients') }}" class="nav-link {{ request()->routeIs('admin.patients') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Patients
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('admin.appointments') }}" class="nav-link {{ request()->routeIs('admin.appointments') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check"></i> Appointments
                </a>
            </div>
            <hr class="sidebar-divider">
            <div class="nav-item">
                <a href="{{ route('admin.profile') }}" class="nav-link">
                    <i class="fas fa-user-cog"></i> Profile
                </a>
            </div>
        @elseif(auth()->user()->role === 'doctor')
            <div class="nav-item">
                <a href="{{ route('doctor.dashboard') }}" class="nav-link {{ request()->routeIs('doctor.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i> Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('doctor.appointments') }}" class="nav-link {{ request()->routeIs('doctor.appointments') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check"></i> Appointments
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('doctor.prescriptions') }}" class="nav-link {{ request()->routeIs('doctor.prescriptions*') ? 'active' : '' }}">
                    <i class="fas fa-prescription-bottle-alt"></i> Prescriptions
                </a>
            </div>
            <hr class="sidebar-divider">
            <div class="nav-item">
                <a href="{{ route('doctor.profile') }}" class="nav-link">
                    <i class="fas fa-user-cog"></i> Profile
                </a>
            </div>
        @else
            <div class="nav-item">
                <a href="{{ route('patient.dashboard') }}" class="nav-link {{ request()->routeIs('patient.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-pie"></i> Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('patient.appointments') }}" class="nav-link {{ request()->routeIs('patient.appointments*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check"></i> My Appointments
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('patient.appointments.book') }}" class="nav-link">
                    <i class="fas fa-plus-circle"></i> Book Appointment
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('patient.prescriptions') }}" class="nav-link {{ request()->routeIs('patient.prescriptions*') ? 'active' : '' }}">
                    <i class="fas fa-file-medical"></i> Prescriptions
                </a>
            </div>
            <hr class="sidebar-divider">
            <div class="px-3 py-2" style="color:rgba(255,255,255,0.5);font-size:0.75rem;font-weight:700;letter-spacing:1px">AI FEATURES</div>
            <div class="nav-item">
                <a href="{{ route('patient.ai.symptom') }}" class="nav-link {{ request()->routeIs('patient.ai.symptom') ? 'active' : '' }}">
                    <i class="fas fa-stethoscope"></i> Symptom Checker
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('patient.ai.chatbot') }}" class="nav-link {{ request()->routeIs('patient.ai.chatbot') ? 'active' : '' }}">
                    <i class="fas fa-robot"></i> AI Health Chat
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('patient.ai.health_risk') }}" class="nav-link {{ request()->routeIs('patient.ai.health_risk') ? 'active' : '' }}">
                    <i class="fas fa-heart-pulse"></i> Health Risk
                </a>
            </div>
            <hr class="sidebar-divider">
            <div class="nav-item">
                <a href="{{ route('patient.profile') }}" class="nav-link">
                    <i class="fas fa-user-cog"></i> Profile
                </a>
            </div>
        @endif

        <hr class="sidebar-divider">
        <div class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link w-100 text-start border-0" style="background:none;color:rgba(255,100,100,0.9)">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </nav>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    <div class="topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-sm btn-outline-secondary d-md-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="fas fa-bars"></i>
            </button>
            <span class="topbar-title">@yield('title')</span>
        </div>
        <div class="user-info">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div style="font-weight:700;color:var(--primary)">{{ auth()->user()->name }}</div>
                <div style="font-size:0.75rem;color:#6c757d">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
        </div>
    </div>

    <div class="p-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>