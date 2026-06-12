@extends('layouts.dashboard')
@section('title', 'All Patients')

@section('content')
<div class="content-card">
    <div class="content-card-header">
        <h5><i class="fas fa-users me-2" style="color:#00d4aa"></i>All Patients</h5>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Gender</th><th>Blood Group</th><th>Registered</th></tr></thead>
            <tbody>
                @forelse($patients as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:38px;height:38px;background:linear-gradient(135deg,#00d4aa,#0f4c75);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:0.9rem">
                                {{ strtoupper(substr($p->patient_name,0,1)) }}
                            </div>
                            {{ $p->patient_name }}
                        </div>
                    </td>
                    <td>{{ $p->user->email }}</td>
                    <td>{{ $p->phone }}</td>
                    <td>{{ ucfirst($p->gender ?? '—') }}</td>
                    <td>{{ $p->blood_group ?? '—' }}</td>
                    <td>{{ $p->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4 text-muted">No patients found</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection