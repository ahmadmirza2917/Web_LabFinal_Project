@extends('layouts.dashboard')
@section('title', 'AI Symptom Checker')

@section('content')
<div class="row g-4">
    <div class="col-lg-6">
        <div class="content-card">
            <div class="content-card-header">
                <h5><i class="fas fa-stethoscope me-2" style="color:#00d4aa"></i>AI Symptom Checker</h5>
            </div>
            <p class="text-muted mb-4">Describe your symptoms and our AI will suggest possible conditions and recommended specialists.</p>

            <form action="{{ route('patient.ai.symptom.check') }}" method="POST" id="symptomForm">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Your Symptoms <span class="text-danger">*</span></label>
                    <textarea name="symptoms" class="form-control @error('symptoms') is-invalid @enderror"
                        rows="5" placeholder="e.g. I have fever since 3 days, severe headache, body pain, and cough..."
                        required minlength="5">{{ old('symptoms', request()->old('symptoms')) }}</textarea>
                    @error('symptoms')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-4">
                    <p class="fw-bold mb-2">Common Symptoms (click to add):</p>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach(['Fever','Headache','Cough','Cold','Body Pain','Fatigue','Nausea','Vomiting','Dizziness','Chest Pain','Shortness of Breath','Stomach Pain'] as $s)
                        <span class="badge rounded-pill px-3 py-2" style="background:#e3f2fd;color:#0f4c75;cursor:pointer;font-size:0.85rem"
                            onclick="addSymptom('{{ $s }}')">{{ $s }}</span>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-success px-5" id="checkBtn">
                    <i class="fas fa-robot me-2"></i>Analyze Symptoms
                </button>
            </form>

            <div class="mt-4 p-3 rounded-3" style="background:#f8f9fa;font-size:0.82rem;color:#6c757d">
                <i class="fas fa-exclamation-triangle me-2 text-warning"></i>
                <strong>Disclaimer:</strong> AI responses are for informational purposes only. Always consult a qualified doctor for medical advice.
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        @if(session('ai_result'))
        <div class="content-card fade-in">
            <div class="content-card-header">
                <h5><i class="fas fa-brain me-2" style="color:#00d4aa"></i>AI Analysis Result</h5>
                <span class="badge" style="background:#f0fff9;color:#00d4aa;font-size:0.75rem">AI Generated</span>
            </div>
            <div class="mb-3 p-3 rounded-3" style="background:#f0fff9;border-left:4px solid #00d4aa">
                <strong>Your symptoms:</strong> {{ session('user_input') }}
            </div>
            <div style="white-space:pre-wrap;line-height:1.8;color:#333">
                {!! nl2br(e(session('ai_result'))) !!}
            </div>
            <div class="mt-4">
                <a href="{{ route('patient.appointments.book') }}" class="btn btn-success">
                    <i class="fas fa-calendar-plus me-2"></i>Book Appointment Now
                </a>
            </div>
        </div>
        @else
        <div class="content-card d-flex flex-column align-items-center justify-content-center" style="min-height:300px">
            <div style="font-size:5rem;opacity:0.2;animation:float 3s ease-in-out infinite">🤖</div>
            <p class="text-muted mt-3 text-center">Enter your symptoms on the left and click "Analyze Symptoms" to get AI-powered health insights.</p>
        </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
@keyframes float { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-15px)} }
</style>
@endpush

@push('scripts')
<script>
function addSymptom(s) {
    const ta = document.querySelector('textarea[name=symptoms]');
    ta.value = ta.value ? ta.value + ', ' + s : s;
}
document.getElementById('symptomForm').addEventListener('submit', function() {
    const btn = document.getElementById('checkBtn');
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Analyzing...';
    btn.disabled = true;
});
</script>
@endpush