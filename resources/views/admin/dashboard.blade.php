@extends('layouts.dashboard')
@section('title', 'Admin Dashboard')

@section('content')
<div class="row g-4">
    <!-- Stats Cards -->
    <div class="col-md-3 fade-in">
        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#0f4c75,#1b6ca8)">
                <i class="fas fa-user-md"></i>
            </div>
            <div class="stat-number">{{ $stats['total_doctors'] }}</div>
            <div class="stat-label">Total Doctors</div>
        </div>
    </div>
    <div class="col-md-3 fade-in delay-1">
        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#00d4aa,#00b891)">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-number">{{ $stats['total_patients'] }}</div>
            <div class="stat-label">Total Patients</div>
        </div>
    </div>
    <div class="col-md-3 fade-in delay-2">
        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#f39c12,#e67e22)">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div class="stat-number">{{ $stats['total_appointments'] }}</div>
            <div class="stat-label">Total Appointments</div>
        </div>
    </div>
    <div class="col-md-3 fade-in delay-3">
        <div class="stat-card">
            <div class="stat-icon" style="background:linear-gradient(135deg,#e74c3c,#c0392b)">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-number">{{ $stats['pending_appointments'] }}</div>
            <div class="stat-label">Pending Approvals</div>
        </div>
    </div>

    <!-- Recent Appointments -->
    <div class="col-12 fade-in delay-2">
        <div class="content-card">
            <div class="content-card-header">
                <h5><i class="fas fa-calendar-alt me-2" style="color:#00d4aa"></i>Recent Appointments</h5>
                <a href="{{ route('admin.appointments') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent_appointments as $apt)
                        <tr>
                            <td>{{ $apt->id }}</td>
                            <td>{{ $apt->patient->patient_name ?? 'N/A' }}</td>
                            <td>{{ $apt->doctor->doctor_name ?? 'N/A' }}</td>
                            <td>{{ $apt->appointment_date }}</td>
                            <td>
                                <span class="badge badge-{{ $apt->status }} px-3 py-2 rounded-pill">
                                    {{ ucfirst($apt->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No appointments yet</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection