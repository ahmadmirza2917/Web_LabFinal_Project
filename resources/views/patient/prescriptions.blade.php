@extends('layouts.dashboard')
@section('title', 'My Prescriptions')

@section('content')
<div class="content-card">
    <div class="content-card-header">
        <h5><i class="fas fa-file-medical me-2" style="color:#00d4aa"></i>My Prescriptions</h5>
    </div>
    <div class="row g-4">
        @forelse($prescriptions as $p)
        <div class="col-md-6">
            <div style="border:1px solid #e9ecef;border-radius:14px;padding:20px;transition:all 0.3s;background:#fff" onmouseover="this.style.boxShadow='0 8px 25px rgba(0,0,0,0.1)'" onmouseout="this.style.boxShadow='none'">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h6 class="fw-bold mb-0">{{ $p->doctor->doctor_name ?? 'Doctor' }}</h6>
                        <small class="text-muted">{{ $p->doctor->specialization ?? '' }}</small>
                    </div>
                    <span class="badge rounded-pill px-3" style="background:#d1edff;color:#0f4c75">{{ $p->prescription_date }}</span>
                </div>
                <div class="mb-2">
                    <small class="text-muted fw-bold">DIAGNOSIS:</small>
                    <p class="mb-1">{{ Str::limit($p->diagnosis, 80) }}</p>
                </div>
                <div class="mb-3">
                    <small class="text-muted fw-bold">MEDICINES:</small>
                    <p class="mb-0">{{ Str::limit($p->medicines, 80) }}</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('patient.prescriptions.show', $p->id) }}" class="btn btn-sm btn-primary rounded-pill">
                        <i class="fas fa-eye me-1"></i>View Full
                    </a>
                    <button onclick="explainPrescription({{ $p->id }})" class="btn btn-sm btn-outline-success rounded-pill">
                        <i class="fas fa-robot me-1"></i>AI Explain
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5 text-muted">
            <i class="fas fa-file-medical fa-3x mb-3 d-block" style="opacity:0.3"></i>
            No prescriptions yet. Book an appointment to get started.
        </div>
        @endforelse
    </div>
</div>

<!-- AI Explanation Modal -->
<div class="modal fade" id="aiModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius:16px;border:none">
            <div class="modal-header" style="background:linear-gradient(135deg,#0f4c75,#00d4aa);border-radius:16px 16px 0 0">
                <h5 class="modal-title text-white"><i class="fas fa-robot me-2"></i>AI Prescription Explanation</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4" id="aiModalBody">
                <div class="text-center py-4">
                    <div class="spinner-border text-success"></div>
                    <p class="mt-3 text-muted">AI is analyzing your prescription...</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const csrf = document.querySelector('meta[name="csrf-token"]').content;

async function explainPrescription(id) {
    const modal = new bootstrap.Modal(document.getElementById('aiModal'));
    document.getElementById('aiModalBody').innerHTML = `<div class="text-center py-4"><div class="spinner-border text-success"></div><p class="mt-3 text-muted">AI is analyzing your prescription...</p></div>`;
    modal.show();

    try {
        const res = await fetch(`/patient/ai/explain-prescription/${id}`, {
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':csrf},
            body:'{}'
        });
        const data = await res.json();
        document.getElementById('aiModalBody').innerHTML = `<div style="white-space:pre-wrap;line-height:1.9">${data.explanation.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/\n/g,'<br>')}</div>`;
    } catch(e) {
        document.getElementById('aiModalBody').innerHTML = '<p class="text-danger">Failed to get AI explanation. Please try again.</p>';
    }
}
</script>
@endpush