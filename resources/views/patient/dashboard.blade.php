@extends('layouts.dashboard')
@section('title', 'Patient Dashboard')

@section('content')
<div class="row g-4">
    <div class="col-12 mb-2">
        <div style="background:linear-gradient(135deg,#0f4c75,#00d4aa);border-radius:16px;padding:25px;color:#fff;display:flex;justify-content:space-between;align-items:center">
            <div>
                <h4 class="mb-1">Hello, {{ $patient->patient_name }}! 👋</h4>
                <p class="mb-0" style="opacity:0.85">Take care of your health. Book an appointment today.</p>
            </div>
            <a href="{{ route('patient.appointments.book') }}" class="btn" style="background:#fff;color:#0f4c75;font-weight:700;border-radius:12px;padding:12px 25px">
                <i class="fas fa-plus me-2"></i>Book Appointment
            </a>
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
            <div class="stat-icon" style="background:linear-gradient(135deg,#6c63ff,#4c44d4)"><i class="fas fa-file-medical"></i></div>
            <div class="stat-number">{{ $stats['prescriptions'] }}</div>
            <div class="stat-label">Prescriptions</div>
        </div>
    </div>

    <!-- AI Features Quick Access -->
    <div class="col-12">
        <div class="content-card">
            <div class="content-card-header">
                <h5><i class="fas fa-robot me-2" style="color:#00d4aa"></i>AI Health Features</h5>
            </div>
            <div class="row g-3">
                <div class="col-md-4">
                    <a href="{{ route('patient.ai.symptom') }}" class="text-decoration-none">
                        <div style="background:linear-gradient(135deg,#0f4c75,#1b6ca8);border-radius:14px;padding:20px;color:#fff;transition:all 0.3s" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                            <i class="fas fa-stethoscope fa-2x mb-3"></i>
                            <h6 class="fw-bold">Symptom Checker</h6>
                            <small style="opacity:0.8">Describe symptoms, get AI insights</small>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('patient.ai.chatbot') }}" class="text-decoration-none">
                        <div style="background:linear-gradient(135deg,#00d4aa,#00b891);border-radius:14px;padding:20px;color:#fff;transition:all 0.3s" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                            <i class="fas fa-comments fa-2x mb-3"></i>
                            <h6 class="fw-bold">Health Chatbot</h6>
                            <small style="opacity:0.8">Ask health questions instantly</small>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ route('patient.ai.health_risk') }}" class="text-decoration-none">
                        <div style="background:linear-gradient(135deg,#6c63ff,#4c44d4);border-radius:14px;padding:20px;color:#fff;transition:all 0.3s" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform='translateY(0)'">
                            <i class="fas fa-heart-pulse fa-2x mb-3"></i>
                            <h6 class="fw-bold">Health Risk Check</h6>
                            <small style="opacity:0.8">Analyze your health data</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Appointments -->
    <div class="col-12">
        <div class="content-card">
            <div class="content-card-header">
                <h5><i class="fas fa-calendar me-2" style="color:#00d4aa"></i>Recent Appointments</h5>
                <a href="{{ route('patient.appointments') }}" class="btn btn-sm btn-primary">View All</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Specialization</th>
                            <th>Date</th>
                            <th>Symptoms</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recent as $apt)
                        <tr>
                            <td>{{ $apt->doctor->doctor_name ?? 'N/A' }}</td>
                            <td><small class="text-muted">{{ $apt->doctor->specialization ?? '' }}</small></td>
                            <td>{{ $apt->appointment_date }}</td>
                            <td>
                                @if($apt->symptoms)
                                    <small class="text-muted" title="{{ $apt->symptoms }}">
                                        {{ Str::limit($apt->symptoms, 35) }}
                                    </small>
                                @else
                                    <small class="text-muted">—</small>
                                @endif
                            </td>
                            <td><span class="badge badge-{{ $apt->status }} px-3 py-2 rounded-pill">{{ ucfirst($apt->status) }}</span></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No appointments yet. <a href="{{ route('patient.appointments.book') }}">Book now!</a></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection