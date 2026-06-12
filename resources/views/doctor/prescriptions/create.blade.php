@extends('layouts.dashboard')
@section('title', 'Write Prescription')

@section('content')
<div class="content-card" style="max-width:800px;margin:0 auto">
    <div class="content-card-header">
        <h5><i class="fas fa-prescription me-2" style="color:#00d4aa"></i>Write Prescription</h5>
        <a href="{{ route('doctor.appointments') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back
        </a>
    </div>

    <div class="alert" style="background:#f0fff9;border-left:4px solid #00d4aa;border-radius:10px">
        <strong>Patient:</strong> {{ $appointment->patient->patient_name ?? 'N/A' }} |
        <strong>Date:</strong> {{ $appointment->appointment_date }} |
        <strong>Symptoms:</strong> {{ $appointment->symptoms ?? 'None mentioned' }}
    </div>

    <form action="{{ route('doctor.prescriptions.store') }}" method="POST">
        @csrf
        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">

        <div class="mb-3">
            <label class="form-label fw-bold">Diagnosis <span class="text-danger">*</span></label>
            <textarea name="diagnosis" class="form-control @error('diagnosis') is-invalid @enderror"
                rows="3" placeholder="Enter diagnosis..." required>{{ old('diagnosis') }}</textarea>
            @error('diagnosis')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Medicines & Dosage <span class="text-danger">*</span></label>
            <textarea name="medicines" class="form-control @error('medicines') is-invalid @enderror"
                rows="4" placeholder="e.g. Paracetamol 500mg - 1 tablet 3 times a day for 5 days..." required>{{ old('medicines') }}</textarea>
            @error('medicines')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Additional Instructions</label>
            <textarea name="instructions" class="form-control" rows="3"
                placeholder="Rest, diet advice, follow-up instructions...">{{ old('instructions') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success px-5">
            <i class="fas fa-save me-2"></i>Save Prescription
        </button>
    </form>
</div>
@endsection