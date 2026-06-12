@extends('layouts.dashboard')
@section('title', 'Doctor Dashboard')

@section('content')
<div class="row g-4">
    <div class="col-12 mb-2">
        <div style="background:linear-gradient(135deg,#0f4c75,#00d4aa);border-radius:16px;padding:25px;color:#fff">
            <h4 class="mb-0">Welcome back, {{ $doctor->doctor_name }}! 👋</h4>
            <p class="mb-0 mt-1" style="opacity:0.85">{{ $doctor->specialization }} | {{ $doctor->experience ?? 'Experienced' }}</p>
        </div>
    </div>

    <div class="col-md-3 fade-in">
        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#0f4c75,#1b6ca8)"><i class="fas fa-calendar-alt"></i></div>
            <div class="stat-number">{{ $stats['total_appointments'] }}</div>
            <div class="stat-label">Total Appointments</div>
        </div>
    </div>
    <div class="col-md-3 fade-in delay-1">
        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#f39c12,#e67e22)"><i class="fas fa-clock"></i></div>
            <div class="stat-number">{{ $stats['pending'] }}</div>
            <div class="stat-label">Pending</div>
        </div>
    </div>
    <div class="col-md-3 fade-in delay-2">
        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#00d4aa,#00b891)"><i class="fas fa-check-circle"></i></div>
            <div class="stat-number">{{ $stats['approved'] }}</div>
            <div class="stat-label">Approved</div>
        </div>
    </div>
    <div class="col-md-3 fade-in delay-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#6c63ff,#4c44d4)"><i class="fas fa-prescription-bottle-alt"></i></div>
            <div class="stat-number">{{ $stats['completed'] }}</div>
            <div class="stat-label">Completed</div>
        </div>
    </div>

    <div class="col-12">
        <div class="content-card">
            <div class="content-card-header">
                <h5><i class="fas fa-calendar me-2" style="color:#00d4aa"></i>Recent Appointments</h5>
                <a href="{{ route('doctor.appointments') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead><tr><th>Patient</th><th>Date</th><th>Time</th><th>Symptoms</th><th>Status</th><th>Action</th></tr></thead>
                    <tbody>
                        @forelse($recent as $apt)
                        <tr>
                            <td>{{ $apt->patient->patient_name ?? 'N/A' }}</td>
                            <td>{{ $apt->appointment_date }}</td>
                            <td>{{ $apt->appointment_time }}</td>
                            <td><small>{{ Str::limit($apt->symptoms ?? 'N/A', 40) }}</small></td>
                            <td><span class="badge badge-{{ $apt->status }} px-3 py-2 rounded-pill">{{ ucfirst($apt->status) }}</span></td>
                            <td>
                                @if($apt->status === 'approved' && !$apt->prescription)
                                <a href="{{ route('doctor.prescriptions.create', $apt->id) }}" class="btn btn-sm btn-success rounded-pill">
                                    <i class="fas fa-plus me-1"></i>Prescribe
                                </a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No appointments</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection