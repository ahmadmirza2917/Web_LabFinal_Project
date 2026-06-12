@extends('layouts.dashboard')
@section('title', 'Doctor Details')

@section('content')
<div class="content-card" style="max-width:700px;margin:0 auto">
    <div class="content-card-header">
        <h5><i class="fas fa-user-md me-2" style="color:#00d4aa"></i>Doctor Details</h5>
        <a href="{{ route('admin.doctors.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back
        </a>
    </div>
    <div class="text-center mb-4">
        <div style="width:90px;height:90px;background:linear-gradient(135deg,#0f4c75,#00d4aa);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:2rem;margin:0 auto">
            {{ strtoupper(substr($doctor->doctor_name,0,1)) }}
        </div>
        <h4 class="mt-3 mb-0">{{ $doctor->doctor_name }}</h4>
        <span class="badge bg-primary rounded-pill px-3 mt-2">{{ $doctor->specialization }}</span>
    </div>
    <div class="row g-3">
        <div class="col-md-6"><strong>Email:</strong> {{ $doctor->user->email }}</div>
        <div class="col-md-6"><strong>Phone:</strong> {{ $doctor->phone }}</div>
        <div class="col-md-6"><strong>Fee:</strong> Rs. {{ number_format($doctor->consultation_fee) }}</div>
        <div class="col-md-6"><strong>Experience:</strong> {{ $doctor->experience ?? 'N/A' }}</div>
        <div class="col-md-12"><strong>Qualification:</strong> {{ $doctor->qualification ?? 'N/A' }}</div>
        <div class="col-md-12"><strong>Bio:</strong> {{ $doctor->bio ?? 'N/A' }}</div>
    </div>
</div>
@endsection