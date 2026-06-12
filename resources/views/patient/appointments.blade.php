@extends('layouts.dashboard')
@section('title', 'My Appointments')

@section('content')
<div class="content-card">
    <div class="content-card-header">
        <h5><i class="fas fa-calendar-check me-2" style="color:#00d4aa"></i>My Appointments</h5>
        <a href="{{ route('patient.appointments.book') }}" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Book New
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mx-3 mt-3 border-0 rounded-3">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mx-3 mt-3 border-0 rounded-3">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Doctor</th>
                    <th>Specialization</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Symptoms</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $apt)
                <tr>
                    <td>{{ $apt->id }}</td>
                    <td>{{ $apt->doctor->doctor_name ?? 'N/A' }}</td>
                    <td><small class="text-muted">{{ $apt->doctor->specialization ?? '' }}</small></td>
                    <td>{{ $apt->appointment_date }}</td>
                    <td>{{ date('h:i A', strtotime($apt->appointment_time)) }}</td>
                    <td><small class="text-muted">{{ $apt->symptoms ? Str::limit($apt->symptoms, 40) : '—' }}</small></td>
                    <td><span class="badge badge-{{ $apt->status }} px-3 py-2 rounded-pill">{{ ucfirst($apt->status) }}</span></td>
                    <td>
                        <div class="d-flex gap-1 flex-wrap">
                            @if($apt->prescription)
                                <a href="{{ route('patient.prescriptions.show', $apt->prescription->id) }}" class="btn btn-sm btn-primary rounded-pill">
                                    <i class="fas fa-file-medical me-1"></i>Rx
                                </a>
                            @endif

                            @if($apt->status === 'pending')
                                <a href="{{ route('patient.appointments.edit', $apt->id) }}" class="btn btn-sm btn-warning rounded-pill">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </a>
                            @endif

                            @if(in_array($apt->status, ['pending', 'rejected']))
                                <form action="{{ route('patient.appointments.destroy', $apt->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger rounded-pill">
                                        <i class="fas fa-trash me-1"></i>Delete
                                    </button>
                                </form>
                            @endif

                            @if(!$apt->prescription && $apt->status !== 'pending' && $apt->status !== 'rejected')
                                <span class="text-muted small">—</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center py-4 text-muted">No appointments found. <a href="{{ route('patient.appointments.book') }}">Book now!</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection