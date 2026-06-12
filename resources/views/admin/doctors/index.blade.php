@extends('layouts.dashboard')
@section('title', 'Manage Doctors')

@section('content')
<div class="content-card">
    <div class="content-card-header">
        <h5><i class="fas fa-user-md me-2" style="color:#00d4aa"></i>All Doctors</h5>
        <a href="{{ route('admin.doctors.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>Add Doctor
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead><tr><th>#</th><th>Name</th><th>Specialization</th><th>Phone</th><th>Fee</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->id }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:40px;height:40px;background:linear-gradient(135deg,#0f4c75,#00d4aa);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700">
                                {{ strtoupper(substr($doctor->doctor_name,0,1)) }}
                            </div>
                            <div>
                                <div class="fw-bold">{{ $doctor->doctor_name }}</div>
                                <small class="text-muted">{{ $doctor->user->email }}</small>
                            </div>
                        </div>
                    </td>
                    <td><span class="badge bg-primary rounded-pill px-3">{{ $doctor->specialization }}</span></td>
                    <td>{{ $doctor->phone }}</td>
                    <td>Rs. {{ number_format($doctor->consultation_fee) }}</td>
                    <td>
                        @if($doctor->is_available)
                            <span class="badge badge-approved px-3 py-2 rounded-pill">Available</span>
                        @else
                            <span class="badge badge-rejected px-3 py-2 rounded-pill">Unavailable</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-sm btn-warning rounded-pill me-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Delete this doctor?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger rounded-pill"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">No doctors found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection