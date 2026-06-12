@extends('layouts.auth')
@section('title', 'Login')

@push('styles')
<style>
.auth-section {
    min-height:100vh; background:linear-gradient(135deg, #0a2540 0%, #0f4c75 50%, #1b6ca8 100%);
    display:flex; align-items:center; position:relative; overflow:hidden;
}
.auth-section::before {
    content:''; position:absolute; top:-50%; left:-50%; width:200%; height:200%;
    background:radial-gradient(circle, rgba(0,212,170,0.08) 0%, transparent 60%);
    animation:rotate 20s linear infinite;
}
@keyframes rotate { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }

.auth-card {
    background:rgba(255,255,255,0.97); border-radius:24px; padding:45px;
    box-shadow:0 25px 60px rgba(0,0,0,0.3); position:relative; z-index:2;
    animation:slideUp 0.6s ease;
}
@keyframes slideUp { from{opacity:0;transform:translateY(40px)} to{opacity:1;transform:translateY(0)} }

.auth-logo {
    font-family:'Playfair Display',serif; font-size:2rem; color:#0f4c75;
    text-align:center; margin-bottom:8px;
}
.auth-logo span{color:#00d4aa}
.auth-subtitle { text-align:center; color:#6c757d; margin-bottom:30px; font-weight:600; }

.role-tabs { display:flex; gap:8px; margin-bottom:25px; }
.role-tab {
    flex:1; padding:12px; border:2px solid #e9ecef; border-radius:12px; text-align:center;
    cursor:pointer; font-weight:700; transition:all 0.3s; color:#6c757d; background:#fff;
}
.role-tab.active { border-color:#00d4aa; background:#f0fff9; color:#0f4c75; }
.role-tab i { display:block; font-size:1.5rem; margin-bottom:4px; }

.form-floating label { color:#6c757d; }
.form-floating .form-control { border-radius:12px; border:2px solid #e9ecef; }
.form-floating .form-control:focus { border-color:#00d4aa; box-shadow:0 0 0 3px rgba(0,212,170,0.15); }

.btn-auth {
    width:100%; background:linear-gradient(135deg,#0f4c75,#00d4aa); color:#fff;
    border:none; border-radius:12px; padding:14px; font-size:1rem; font-weight:700;
    cursor:pointer; transition:all 0.3s; margin-top:10px;
}
.btn-auth:hover { transform:translateY(-2px); box-shadow:0 8px 25px rgba(0,212,170,0.4); }

.divider { text-align:center; margin:20px 0; color:#6c757d; position:relative; }
.divider::before { content:''; position:absolute; left:0; top:50%; width:45%; height:1px; background:#e9ecef; }
.divider::after { content:''; position:absolute; right:0; top:50%; width:45%; height:1px; background:#e9ecef; }

.info-panel {
    color:#fff; padding:40px;
}
.info-panel h2 { font-family:'Playfair Display',serif; font-size:2.5rem; margin-bottom:20px; }
.info-feature {
    display:flex; align-items:center; gap:15px; margin-bottom:20px;
    background:rgba(255,255,255,0.1); padding:15px; border-radius:12px;
    backdrop-filter:blur(5px);
}
.info-feature-icon {
    width:45px; height:45px; background:rgba(0,212,170,0.3); border-radius:10px;
    display:flex; align-items:center; justify-content:center; font-size:1.2rem;
    color:#00d4aa; flex-shrink:0;
}
</style>
@endpush

@section('content')
<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100 py-5">
            <div class="col-lg-5 col-md-7">
                <div class="auth-card">
                    <div class="auth-logo"><i class="fas fa-heartbeat me-2" style="color:#00d4aa"></i>Smart<span>Health</span></div>
                    <p class="auth-subtitle">Sign in to your account</p>

                    <!-- Role Tabs -->
                    <div class="role-tabs">
                        <div class="role-tab active" onclick="setRole('patient', this)">
                            <i class="fas fa-user"></i>Patient
                        </div>
                        <div class="role-tab" onclick="setRole('doctor', this)">
                            <i class="fas fa-user-md"></i>Doctor
                        </div>
                        <div class="role-tab" onclick="setRole('admin', this)">
                            <i class="fas fa-shield-alt"></i>Admin
                        </div>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger border-0 rounded-3">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <input type="hidden" name="role_hint" id="role_hint" value="patient">

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                            <label for="email"><i class="fas fa-envelope me-2"></i>Email Address</label>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-floating mb-3 position-relative">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Password" required>
                            <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                            <button type="button" onclick="togglePwd()" class="btn btn-sm position-absolute" style="right:12px;top:12px;border:none;background:none;color:#6c757d">
                                <i class="fas fa-eye" id="pwd-icon"></i>
                            </button>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember me</label>
                            </div>
                        </div>

                        <button type="submit" class="btn-auth">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </button>
                    </form>

                    <div class="divider mt-4">or</div>

                    <p class="text-center mb-0">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="fw-bold" style="color:#00d4aa">Register as Patient</a>
                    </p>

                    <!-- Demo credentials hint -->
                    <div class="mt-3 p-3 rounded-3" style="background:#f0fff9;font-size:0.8rem">
                        <strong>Demo:</strong> admin@smarthealth.com / admin123
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-none d-lg-block">
                <div class="info-panel">
                    <h2>Your Health, Our Priority</h2>
                    <p class="mb-4" style="opacity:0.8;font-size:1.1rem">AI-powered healthcare management at your fingertips</p>

                    <div class="info-feature">
                        <div class="info-feature-icon"><i class="fas fa-robot"></i></div>
                        <div>
                            <strong>AI Symptom Checker</strong>
                            <p class="mb-0" style="opacity:0.8;font-size:0.9rem">Get intelligent health insights instantly</p>
                        </div>
                    </div>
                    <div class="info-feature">
                        <div class="info-feature-icon"><i class="fas fa-calendar-check"></i></div>
                        <div>
                            <strong>Easy Appointments</strong>
                            <p class="mb-0" style="opacity:0.8;font-size:0.9rem">Book with top specialists in seconds</p>
                        </div>
                    </div>
                    <div class="info-feature">
                        <div class="info-feature-icon"><i class="fas fa-prescription-bottle-alt"></i></div>
                        <div>
                            <strong>Digital Prescriptions</strong>
                            <p class="mb-0" style="opacity:0.8;font-size:0.9rem">Access prescriptions anytime, anywhere</p>
                        </div>
                    </div>
                    <div class="info-feature">
                        <div class="info-feature-icon"><i class="fas fa-heart-pulse"></i></div>
                        <div>
                            <strong>Health Risk Assessment</strong>
                            <p class="mb-0" style="opacity:0.8;font-size:0.9rem">AI-powered health monitoring</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
function setRole(role, el) {
    document.querySelectorAll('.role-tab').forEach(t => t.classList.remove('active'));
    el.classList.add('active');
    document.getElementById('role_hint').value = role;
}
function togglePwd() {
    const p = document.getElementById('password');
    const i = document.getElementById('pwd-icon');
    if(p.type === 'password') { p.type='text'; i.className='fas fa-eye-slash'; }
    else { p.type='password'; i.className='fas fa-eye'; }
}
</script>
@endpush