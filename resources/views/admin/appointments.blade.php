@extends('layouts.dashboard')
@section('title', 'Manage Appointments')

@section('content')
<div class="content-card">
    <div class="content-card-header">
        <h5><i class="fas fa-calendar-check me-2" style="color:#00d4aa"></i>All Appointments</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th><th>Patient</th><th>Doctor</th><th>Specialization</th>
                    <th>Date</th><th>Time</th><th>Status</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $apt)
                <tr>
                    <td>{{ $apt->id }}</td>
                    <td>{{ $apt->patient->patient_name ?? 'N/A' }}</td>
                    <td>{{ $apt->doctor->doctor_name ?? 'N/A' }}</td>
                    <td><small class="text-muted">{{ $apt->doctor->specialization ?? '' }}</small></td>
                    <td>{{ $apt->appointment_date }}</td>
                    <td>{{ $apt->appointment_time }}</td>
                    <td>
                        <span class="badge badge-{{ $apt->status }} px-3 py-2 rounded-pill">{{ ucfirst($apt->status) }}</span>
                    </td>
                    <td>
                        @if($apt->status === 'pending')
                        <form action="{{ route('admin.appointments.approve', $apt->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-success rounded-pill">
                                <i class="fas fa-check me-1"></i>Approve
                            </button>
                        </form>
                        <form action="{{ route('admin.appointments.reject', $apt->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button class="btn btn-sm btn-danger rounded-pill">
                                <i class="fas fa-times me-1"></i>Reject
                            </button>
                        </form>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center py-4 text-muted">No appointments found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection