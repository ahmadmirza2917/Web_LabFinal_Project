@extends('layouts.dashboard')
@section('title', 'Health Risk Assessment')

@section('content')
<div class="row g-4">
    <div class="col-lg-5">
        <div class="content-card">
            <div class="content-card-header">
                <h5><i class="fas fa-heart-pulse me-2" style="color:#00d4aa"></i>Health Risk Assessment</h5>
            </div>
            <p class="text-muted mb-4">Enter your health data and our AI will assess your health risk level.</p>

            <form action="{{ route('patient.ai.health_risk.assess') }}" method="POST" id="riskForm">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Age (years) <span class="text-danger">*</span></label>
                        <input type="number" name="age" class="form-control @error('age') is-invalid @enderror"
                            value="{{ old('age', auth()->user()->patient->date_of_birth ? now()->diffInYears(auth()->user()->patient->date_of_birth) : '') }}"
                            min="1" max="120" required>
                        @error('age')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Weight (kg) <span class="text-danger">*</span></label>
                        <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror"
                            value="{{ old('weight', auth()->user()->patient->weight ?? '') }}"
                            step="0.1" min="10" max="300" required>
                        @error('weight')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Blood Pressure (mmHg) <span class="text-danger">*</span></label>
                        <input type="text" name="blood_pressure" class="form-control @error('blood_pressure') is-invalid @enderror"
                            value="{{ old('blood_pressure', auth()->user()->patient->blood_pressure ?? '') }}"
                            placeholder="e.g. 120/80" required>
                        @error('blood_pressure')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-bold">Blood Sugar (mg/dL) <span class="text-danger">*</span></label>
                        <input type="text" name="blood_sugar" class="form-control @error('blood_sugar') is-invalid @enderror"
                            value="{{ old('blood_sugar', auth()->user()->patient->blood_sugar ?? '') }}"
                            placeholder="e.g. 100 (fasting)" required>
                        @error('blood_sugar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 mt-4" id="riskBtn">
                    <i class="fas fa-brain me-2"></i>Assess My Health Risk
                </button>
            </form>
        </div>
    </div>

    <div class="col-lg-7">
        @if(session('ai_result'))
        <div class="content-card fade-in">
            <div class="content-card-header">
                <h5><i class="fas fa-chart-bar me-2" style="color:#00d4aa"></i>Your Risk Assessment</h5>
                <span class="badge" style="background:#f0fff9;color:#00d4aa">AI Generated</span>
            </div>
            <div style="white-space:pre-wrap;line-height:1.9;color:#333">
                {!! nl2br(e(session('ai_result'))) !!}
            </div>
            <div class="mt-4">
                <a href="{{ route('patient.appointments.book') }}" class="btn btn-success me-2">
                    <i class="fas fa-calendar-plus me-2"></i>Book Appointment
                </a>
                <a href="{{ route('patient.ai.symptom') }}" class="btn btn-outline-primary">
                    <i class="fas fa-stethoscope me-2"></i>Check Symptoms
                </a>
            </div>
        </div>
        @else
        <div class="content-card d-flex flex-column align-items-center justify-content-center" style="min-height:350px">
            <div style="font-size:5rem;opacity:0.2;animation:float 3s ease-in-out infinite">❤️</div>
            <p class="text-muted mt-3 text-center">Fill in your health data and click "Assess" to get your personalized health risk report.</p>
        </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-15px)}}</style>
@endpush

@push('scripts')
<script>
document.getElementById('riskForm').addEventListener('submit', function() {
    const btn = document.getElementById('riskBtn');
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Analyzing...';
    btn.disabled = true;
});
</script>
@endpush