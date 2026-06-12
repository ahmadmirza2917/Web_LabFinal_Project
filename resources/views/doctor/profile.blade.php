@extends('layouts.dashboard')
@section('title', 'My Profile')

@section('content')
<div class="content-card" style="max-width:700px;margin:0 auto">
    <div class="content-card-header">
        <h5><i class="fas fa-user-cog me-2" style="color:#00d4aa"></i>My Profile</h5>
    </div>

    <div class="text-center mb-4">
        <div style="width:90px;height:90px;background:linear-gradient(135deg,#0f4c75,#00d4aa);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:2rem;margin:0 auto">
            {{ strtoupper(substr($doctor->doctor_name,0,1)) }}
        </div>
        <span class="badge bg-primary rounded-pill px-3 mt-2">{{ $doctor->specialization }}</span>
    </div>

    <form action="{{ route('doctor.profile.update') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Doctor Name <span class="text-danger">*</span></label>
                <input type="text" name="doctor_name" class="form-control @error('doctor_name') is-invalid @enderror" value="{{ old('doctor_name', $doctor->doctor_name) }}" required>
                @error('doctor_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Phone <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $doctor->phone) }}" required>
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Experience</label>
                <input type="text" name="experience" class="form-control" value="{{ old('experience', $doctor->experience) }}">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Qualification</label>
                <input type="text" name="qualification" class="form-control" value="{{ old('qualification', $doctor->qualification) }}">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">Bio</label>
                <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="4">{{ old('bio', $doctor->bio) }}</textarea>
                @error('bio')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-success px-5">
                    <i class="fas fa-save me-2"></i>Update Profile
                </button>
            </div>
        </div>
    </form>

    <hr class="my-4">
    <h6 class="fw-bold mb-3">Change Password</h6>
    <form action="{{ route('doctor.password.update') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Current Password</label>
                <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">New Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary px-5">
                    <i class="fas fa-key me-2"></i>Change Password
                </button>
            </div>
        </div>
    </form>
</div>
@endsection