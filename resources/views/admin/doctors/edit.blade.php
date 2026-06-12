@extends('layouts.dashboard')
@section('title', 'Edit Doctor')

@section('content')
<div class="content-card" style="max-width:800px;margin:0 auto">
    <div class="content-card-header">
        <h5><i class="fas fa-user-md me-2" style="color:#00d4aa"></i>Edit Doctor</h5>
        <a href="{{ route('admin.doctors.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back
        </a>
    </div>

    <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Doctor Name <span class="text-danger">*</span></label>
                <input type="text" name="doctor_name" class="form-control @error('doctor_name') is-invalid @enderror"
                    value="{{ old('doctor_name', $doctor->doctor_name) }}" required>
                @error('doctor_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Specialization <span class="text-danger">*</span></label>
                <select name="specialization" class="form-select @error('specialization') is-invalid @enderror" required>
                    @foreach(['Cardiologist','Dermatologist','General Physician','Neurologist','Orthopedic','Pediatrician','Psychiatrist','Gynecologist','ENT Specialist','Ophthalmologist'] as $s)
                        <option value="{{ $s }}" {{ old('specialization', $doctor->specialization)===$s?'selected':'' }}>{{ $s }}</option>
                    @endforeach
                </select>
                @error('specialization')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Phone <span class="text-danger">*</span></label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone', $doctor->phone) }}" required>
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Consultation Fee (Rs.) <span class="text-danger">*</span></label>
                <input type="number" name="consultation_fee" class="form-control @error('consultation_fee') is-invalid @enderror"
                    value="{{ old('consultation_fee', $doctor->consultation_fee) }}" required>
                @error('consultation_fee')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                <textarea name="bio" class="form-control" rows="3">{{ old('bio', $doctor->bio) }}</textarea>
            </div>
            <div class="col-12">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_available" id="isAvailable" value="1"
                        {{ old('is_available', $doctor->is_available) ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold" for="isAvailable">Available for Appointments</label>
                </div>
            </div>
            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-success px-5">
                    <i class="fas fa-save me-2"></i>Update Doctor
                </button>
                <a href="{{ route('admin.doctors.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection