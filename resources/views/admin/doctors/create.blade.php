@extends('layouts.dashboard')
@section('title', 'Add New Doctor')

@section('content')
<div class="content-card" style="max-width:800px;margin:0 auto">
    <div class="content-card-header">
        <h5><i class="fas fa-user-md me-2" style="color:#00d4aa"></i>Add New Doctor</h5>
        <a href="{{ route('admin.doctors.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back
        </a>
    </div>

    <form action="{{ route('admin.doctors.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Login Name <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" placeholder="Full name for login" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="doctor@email.com" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Doctor Name <span class="text-danger">*</span></label>
                <input type="text" name="doctor_name" class="form-control @error('doctor_name') is-invalid @enderror"
                    value="{{ old('doctor_name') }}" placeholder="Dr. Full Name" required>
                @error('doctor_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Specialization <span class="text-danger">*</span></label>
                <select name="specialization" class="form-select @error('specialization') is-invalid @enderror" required>
                    <option value="">Select Specialization</option>
                    @foreach(['Cardiologist','Dermatologist','General Physician','Neurologist','Orthopedic','Pediatrician','Psychiatrist','Gynecologist','ENT Specialist','Ophthalmologist'] as $s)
                        <option value="{{ $s }}" {{ old('specialization')===$s?'selected':'' }}>{{ $s }}</option>
                    @endforeach
                </select>
                @error('specialization')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Phone <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone') }}" placeholder="03xx xxxxxxx" required>
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Consultation Fee (Rs.) <span class="text-danger">*</span></label>
                <input type="number" name="consultation_fee" class="form-control @error('consultation_fee') is-invalid @enderror"
                    value="{{ old('consultation_fee') }}" placeholder="1500" required>
                @error('consultation_fee')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Experience</label>
                <input type="text" name="experience" class="form-control" value="{{ old('experience') }}" placeholder="e.g. 10 Years">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Qualification</label>
                <input type="text" name="qualification" class="form-control" value="{{ old('qualification') }}" placeholder="MBBS, MD">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">Bio</label>
                <textarea name="bio" class="form-control" rows="3" placeholder="Doctor's bio...">{{ old('bio') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Confirm Password <span class="text-danger">*</span></label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-success px-5">
                    <i class="fas fa-save me-2"></i>Save Doctor
                </button>
                <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection