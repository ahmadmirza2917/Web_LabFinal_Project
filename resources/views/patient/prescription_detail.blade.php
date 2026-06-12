@extends('layouts.dashboard')
@section('title', 'Prescription Details')

@section('content')
<div class="content-card" style="max-width:700px;margin:0 auto">
    <div class="content-card-header">
        <h5><i class="fas fa-prescription me-2" style="color:#00d4aa"></i>Prescription Details</h5>
        <a href="{{ route('patient.prescriptions') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back
        </a>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-6"><strong>Doctor:</strong> {{ $prescription->doctor->doctor_name ?? 'N/A' }}</div>
        <div class="col-md-6"><strong>Date:</strong> {{ $prescription->prescription_date }}</div>
        <div class="col-md-12"><strong>Specialization:</strong> {{ $prescription->doctor->specialization ?? '' }}</div>
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

    <button onclick="explainPrescription({{ $prescription->id }})" class="btn btn-outline-success mt-2">
        <i class="fas fa-robot me-2"></i>Get AI Explanation
    </button>

    <div id="aiResult" class="mt-3 d-none p-3 rounded-3" style="background:#e3f2fd"></div>
</div>
@endsection

@push('scripts')
<script>
const csrf = document.querySelector('meta[name="csrf-token"]').content;
async function explainPrescription(id) {
    const box = document.getElementById('aiResult');
    box.classList.remove('d-none');
    box.innerHTML = '<div class="spinner-border spinner-border-sm text-success"></div> Loading AI explanation...';
    try {
        const res = await fetch(`/patient/ai/explain-prescription/${id}`, {
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf},
            body:'{}'
        });
        const data = await res.json();
        box.innerHTML = `<div style="white-space:pre-wrap;line-height:1.8">${data.explanation.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/\n/g,'<br>')}</div>`;
    } catch(e) {
        box.innerHTML = '<span class="text-danger">Failed to load explanation.</span>';
    }
}
</script>
@endpush