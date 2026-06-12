@extends('layouts.dashboard')
@section('title', 'My Appointments')

@section('content')
<div class="content-card">
    <div class="content-card-header">
        <h5><i class="fas fa-calendar-check me-2" style="color:#00d4aa"></i>My Appointments</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead><tr><th>#</th><th>Patient</th><th>Date</th><th>Time</th><th>Symptoms</th><th>Status</th><th>Action</th></tr></thead>
            <tbody>
                @forelse($appointments as $apt)
                <tr>
                    <td>{{ $apt->id }}</td>
                    <td>{{ $apt->patient->patient_name ?? 'N/A' }}</td>
                    <td>{{ $apt->appointment_date }}</td>
                    <td>{{ $apt->appointment_time }}</td>
                    <td><small class="text-muted">{{ Str::limit($apt->symptoms ?? '—', 50) }}</small></td>
                    <td><span class="badge badge-{{ $apt->status }} px-3 py-2 rounded-pill">{{ ucfirst($apt->status) }}</span></td>
                    <td>
                        @if($apt->status === 'approved' && !$apt->prescription)
                        <a href="{{ route('doctor.prescriptions.create', $apt->id) }}" class="btn btn-sm btn-success rounded-pill">
                            <i class="fas fa-file-medical me-1"></i>Write Prescription
                        </a>
                        @elseif($apt->prescription)
                        <a href="{{ route('doctor.prescriptions.show', $apt->prescription->id) }}" class="btn btn-sm btn-primary rounded-pill">
                            <i class="fas fa-eye me-1"></i>View
                        </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">No appointments found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection