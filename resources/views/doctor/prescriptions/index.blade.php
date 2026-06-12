@extends('layouts.dashboard')
@section('title', 'My Prescriptions')

@section('content')
<div class="content-card">
    <div class="content-card-header">
        <h5><i class="fas fa-prescription-bottle-alt me-2" style="color:#00d4aa"></i>Prescriptions Written</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead><tr><th>#</th><th>Patient</th><th>Diagnosis</th><th>Symptoms</th><th>Date</th><th>Action</th></tr></thead>
            <tbody>
                @forelse($prescriptions as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->patient->patient_name ?? 'N/A' }}</td>
                    <td>{{ Str::limit($p->diagnosis, 40) }}</td>
                    <td><small class="text-muted">{{ Str::limit($p->appointment->symptoms ?? '—', 40) }}</small></td>
                    <td>{{ $p->prescription_date }}</td>
                    <td>
                        <a href="{{ route('doctor.prescriptions.show', $p->id) }}" class="btn btn-sm btn-primary rounded-pill">
                            <i class="fas fa-eye me-1"></i>View
                        </a>
                        <a href="{{ route('doctor.prescriptions.edit', $p->id) }}" class="btn btn-sm btn-warning rounded-pill">
                            <i class="fas fa-edit me-1"></i>Edit
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">No prescriptions written yet</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection