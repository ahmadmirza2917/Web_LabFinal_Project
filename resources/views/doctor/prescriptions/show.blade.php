@extends('layouts.dashboard')
@section('title', 'Prescription Details')

@section('content')
<div class="content-card" style="max-width:700px;margin:0 auto">
    <div class="content-card-header">
        <h5><i class="fas fa-prescription me-2" style="color:#00d4aa"></i>Prescription #{{ $prescription->id }}</h5>
        <a href="{{ route('doctor.prescriptions') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back
        </a>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-6"><strong>Patient:</strong> {{ $prescription->patient->patient_name ?? 'N/A' }}</div>
        <div class="col-md-6"><strong>Date:</strong> {{ $prescription->prescription_date }}</div>
    </div>

    <div class="mb-3 p-3 rounded-3" style="background:#f0fff9">
        <strong>Diagnosis:</strong>
        <p class="mb-0 mt-1">{{ $prescription->diagnosis }}</p>
    </div>
    <div class="mb-3 p-3 rounded-3" style="background:#f8f9fa">
        <strong>Medicines:</strong>
        <p class="mb-0 mt-1" style="white-space:pre-wrap">{{ $prescription->medicines }}</p>
    </div>
    @if($prescription->instructions)
    <div class="mb-3 p-3 rounded-3" style="background:#fff3cd">
        <strong>Instructions:</strong>
        <p class="mb-0 mt-1" style="white-space:pre-wrap">{{ $prescription->instructions }}</p>
    </div>
    @endif
</div>
@endsection