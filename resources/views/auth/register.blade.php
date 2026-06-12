@extends('layouts.auth')
@section('title', 'Register')

@push('styles')
<style>
.auth-section {
    min-height:100vh; background:linear-gradient(135deg,#0a2540 0%,#0f4c75 50%,#1b6ca8 100%);
    display:flex; align-items:center; position:relative; overflow:hidden; padding:40px 0;
}
.auth-card {
    background:rgba(255,255,255,0.97); border-radius:24px; padding:40px;
    box-shadow:0 25px 60px rgba(0,0,0,0.3); animation:slideUp 0.6s ease;
}
@keyframes slideUp { from{opacity:0;transform:translateY(40px)} to{opacity:1;transform:translateY(0)} }
.auth-logo { font-family:'Playfair Display',serif; font-size:2rem; color:#0f4c75; text-align:center; }
.auth-logo span{color:#00d4aa}
.section-title { font-weight:700; color:#0f4c75; border-left:4px solid #00d4aa; padding-left:10px; margin:20px 0 15px; }
.form-control,.form-select { border-radius:10px; border:2px solid #e9ecef; padding:10px 15px; }
.form-control:focus,.form-select:focus { border-color:#00d4aa; box-shadow:0 0 0 3px rgba(0,212,170,0.15); }
.btn-auth {
    width:100%; background:linear-gradient(135deg,#0f4c75,#00d4aa); color:#fff;
    border:none; border-radius:12px; padding:14px; font-size:1rem; font-weight:700;
    cursor:pointer; transition:all 0.3s;
}
.btn-auth:hover { transform:translateY(-2px); box-shadow:0 8px 25px rgba(0,212,170,0.4); }
.strength-bar { height:5px; border-radius:3px; transition:all 0.3s; margin-top:5px; }
</style>
@endpush

@section('content')
<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center py-4">
            <div class="col-lg-8 col-md-10">
                <div class="auth-card">
                    <div class="auth-logo mb-2"><i class="fas fa-heartbeat me-2" style="color:#00d4aa"></i>Smart<span>Health</span></div>
                    <p class="text-center text-muted mb-4 fw-600">Create your patient account</p>

                    @if($errors->any())
                        <div class="alert alert-danger border-0 rounded-3">
                            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                        </div>
                    @endif

                    <form action="{{ route('register.post') }}" method="POST" id="regForm">
                        @csrf

                        <p class="section-title"><i class="fas fa-user me-2"></i>Personal Information</p>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" placeholder="Enter your full name" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone') }}" placeholder="03xx xxxxxxx" required>
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Date of Birth <span class="text-danger">*</span></label>
                                <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror"
                                    value="{{ old('date_of_birth') }}" required>
                                @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Gender <span class="text-danger">*</span></label>
                                <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender')=='male'?'selected':'' }}>Male</option>
                                    <option value="female" {{ old('gender')=='female'?'selected':'' }}>Female</option>
                                    <option value="other" {{ old('gender')=='other'?'selected':'' }}>Other</option>
                                </select>
                                @error('gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <p class="section-title"><i class="fas fa-lock me-2"></i>Account Credentials</p>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" placeholder="your@email.com" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="password" name="password" id="pwd" class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Min 6 characters" oninput="checkStrength()" required>
                                    <button type="button" onclick="togglePwd('pwd','pi1')" class="btn btn-sm position-absolute" style="right:8px;top:8px;border:none;background:none">
                                        <i class="fas fa-eye" id="pi1"></i>
                                    </button>
                                </div>
                                <div class="strength-bar mt-1" id="strengthBar" style="background:#e9ecef;width:100%">
                                    <div id="strengthFill" style="height:5px;border-radius:3px;width:0;transition:all 0.3s"></div>
                                </div>
                                <small id="strengthText" class="text-muted"></small>
                                @error('password')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Confirm Password <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="password" name="password_confirmation" id="cpwd" class="form-control"
                                        placeholder="Re-enter password" required>
                                    <button type="button" onclick="togglePwd('cpwd','pi2')" class="btn btn-sm position-absolute" style="right:8px;top:8px;border:none;background:none">
                                        <i class="fas fa-eye" id="pi2"></i>
                                    </button>
                                </div>
                                <small id="matchMsg"></small>
                            </div>
                        </div>

                        <div class="form-check mb-4">
                            <input type="checkbox" class="form-check-input" id="terms" required>
                            <label class="form-check-label" for="terms">
                                I agree to the <a href="#" style="color:#00d4aa">Terms of Service</a> and <a href="#" style="color:#00d4aa">Privacy Policy</a>
                            </label>
                        </div>

                        <button type="submit" class="btn-auth">
                            <i class="fas fa-user-plus me-2"></i>Create Account
                        </button>
                    </form>

                    <p class="text-center mt-4 mb-0">
                        Already have an account?
                        <a href="{{ route('login') }}" class="fw-bold" style="color:#00d4aa">Sign In</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
function togglePwd(id, iconId) {
    const f = document.getElementById(id);
    const i = document.getElementById(iconId);
    f.type = f.type==='password' ? 'text' : 'password';
    i.className = f.type==='password' ? 'fas fa-eye' : 'fas fa-eye-slash';
}
function checkStrength() {
    const p = document.getElementById('pwd').value;
    const fill = document.getElementById('strengthFill');
    const text = document.getElementById('strengthText');
    let str = 0;
    if(p.length >= 6) str++;
    if(p.match(/[A-Z]/)) str++;
    if(p.match(/[0-9]/)) str++;
    if(p.match(/[^a-zA-Z0-9]/)) str++;
    const colors = ['','#e74c3c','#f39c12','#2ecc71','#00d4aa'];
    const labels = ['','Weak','Fair','Good','Strong'];
    fill.style.width = (str*25)+'%';
    fill.style.background = colors[str];
    text.textContent = labels[str];
    text.style.color = colors[str];
}
document.getElementById('cpwd').addEventListener('input', function() {
    const msg = document.getElementById('matchMsg');
    if(this.value === document.getElementById('pwd').value) {
        msg.textContent = '✓ Passwords match';
        msg.style.color = '#00d4aa';
    } else {
        msg.textContent = '✗ Passwords do not match';
        msg.style.color = '#e74c3c';
    }
});
</script>
@endpush