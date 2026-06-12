@extends('layouts.dashboard')
@section('title', 'Edit Prescription')

@section('content')
<div class="content-card" style="max-width:800px;margin:0 auto">
    <div class="content-card-header">
        <h5><i class="fas fa-edit me-2" style="color:#00d4aa"></i>Edit Prescription #{{ $prescription->id }}</h5>
        <a href="{{ route('doctor.prescriptions.show', $prescription->id) }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="alert" style="background:#f0fff9;border-left:4px solid #00d4aa;border-radius:10px">
        <strong>Patient:</strong> {{ $prescription->appointment->patient->patient_name ?? 'N/A' }} |
        <strong>Date:</strong> {{ $prescription->prescription_date }} |
        <strong>Appointment:</strong> {{ $prescription->appointment->appointment_date ?? 'N/A' }}
    </div>

    <form action="{{ route('doctor.prescriptions.update', $prescription->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Symptoms (optional update)</label>
            <textarea name="symptoms" class="form-control" rows="2"
                placeholder="Update patient symptoms if needed...">{{ old('symptoms', $prescription->appointment->symptoms ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Diagnosis <span class="text-danger">*</span></label>
            <textarea name="diagnosis" class="form-control @error('diagnosis') is-invalid @enderror"
                rows="3" placeholder="Enter diagnosis..." required>{{ old('diagnosis', $prescription->diagnosis) }}</textarea>
            @error('diagnosis')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Medicines & Dosage <span class="text-danger">*</span></label>
            <textarea name="medicines" class="form-control @error('medicines') is-invalid @enderror"
                rows="4" placeholder="e.g. Paracetamol 500mg - 1 tablet 3 times a day for 5 days..." required>{{ old('medicines', $prescription->medicines) }}</textarea>
            @error('medicines')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Additional Instructions</label>
            <textarea name="instructions" class="form-control" rows="3"
                placeholder="Rest, diet advice, follow-up instructions...">{{ old('instructions', $prescription->instructions) }}</textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success px-5">
                <i class="fas fa-save me-2"></i>Update Prescription
            </button>
            <a href="{{ route('doctor.prescriptions.show', $prescription->id) }}" class="btn btn-outline-secondary px-4">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection