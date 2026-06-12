@extends('layouts.dashboard')
@section('title', 'My Profile')

@section('content')
<div style="max-width:750px;margin:0 auto">

    @if(session('success'))
        <div class="alert alert-success border-0 rounded-3 mb-3">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger border-0 rounded-3 mb-3">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        </div>
    @endif

    {{-- Profile Info --}}
    <div class="content-card mb-4">
        <div class="content-card-header">
            <h5><i class="fas fa-user-cog me-2" style="color:#00d4aa"></i>My Profile</h5>
        </div>

        <div class="text-center mb-4">
            <div style="width:90px;height:90px;background:linear-gradient(135deg,#0f4c75,#00d4aa);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:2rem;margin:0 auto">
                {{ strtoupper(substr($patient->patient_name,0,1)) }}
            </div>
            <p class="mt-2 text-muted small">{{ auth()->user()->email }}</p>
        </div>

        <form action="{{ route('patient.profile.update') }}" method="POST">
            @csrf
            <div class="row g-3 px-3 pb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="patient_name" class="form-control @error('patient_name') is-invalid @enderror" value="{{ old('patient_name', $patient->patient_name) }}" required>
                    @error('patient_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Phone <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $patient->phone) }}" required>
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $patient->date_of_birth) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">Select</option>
                        <option value="male" {{ $patient->gender=='male'?'selected':'' }}>Male</option>
                        <option value="female" {{ $patient->gender=='female'?'selected':'' }}>Female</option>
                        <option value="other" {{ $patient->gender=='other'?'selected':'' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Blood Group</label>
                    <select name="blood_group" class="form-select">
                        <option value="">Select</option>
                        @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                            <option value="{{ $bg }}" {{ $patient->blood_group==$bg?'selected':'' }}>{{ $bg }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Weight (kg)</label>
                    <input type="number" step="0.1" name="weight" class="form-control" value="{{ old('weight', $patient->weight) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Blood Pressure</label>
                    <input type="text" name="blood_pressure" class="form-control" placeholder="120/80" value="{{ old('blood_pressure', $patient->blood_pressure) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Blood Sugar (mg/dL)</label>
                    <input type="text" name="blood_sugar" class="form-control" value="{{ old('blood_sugar', $patient->blood_sugar) }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $patient->address) }}">
                </div>
                <div class="col-12 mt-2">
                    <button type="submit" class="btn btn-success px-5">
                        <i class="fas fa-save me-2"></i>Update Profile
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Change Email --}}
    <div class="content-card mb-4">
        <div class="content-card-header">
            <h5><i class="fas fa-envelope me-2" style="color:#00d4aa"></i>Change Email</h5>
        </div>
        <form action="{{ route('patient.email.update') }}" method="POST" class="px-3 pb-3 pt-2">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold">New Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email', auth()->user()->email) }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold">Current Password <span class="text-danger">*</span></label>
                    <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror"
                        placeholder="Enter current password to confirm" required>
                    @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="fas fa-envelope me-2"></i>Update Email
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Change Password --}}
    <div class="content-card mb-4">
        <div class="content-card-header">
            <h5><i class="fas fa-lock me-2" style="color:#00d4aa"></i>Change Password</h5>
        </div>
        <form action="{{ route('patient.password.update') }}" method="POST" class="px-3 pb-3 pt-2">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-bold">Current Password <span class="text-danger">*</span></label>
                    <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror"
                        placeholder="Current password" required>
                    @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">New Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Min 6 characters" required minlength="6">
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-bold">Confirm New Password <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Repeat new password" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-warning px-5">
                        <i class="fas fa-lock me-2"></i>Change Password
                    </button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection