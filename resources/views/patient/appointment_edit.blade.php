
@extends('layouts.dashboard')
@section('title', 'Edit Appointment')

@section('content')
<div class="content-card" style="max-width:700px;margin:0 auto">
    <div class="content-card-header">
        <h5><i class="fas fa-edit me-2" style="color:#00d4aa"></i>Edit Appointment</h5>
        <a href="{{ route('patient.appointments') }}" class="btn btn-sm btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger m-3 border-0 rounded-3">
            <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('patient.appointments.update', $appointment->id) }}" method="POST" class="p-3">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label fw-bold">Select Doctor <span class="text-danger">*</span></label>
                <select name="doctor_id" class="form-select @error('doctor_id') is-invalid @enderror" required>
                    <option value="">-- Choose Doctor --</option>
                    @foreach($doctors as $doc)
                        <option value="{{ $doc->id }}" {{ old('doctor_id', $appointment->doctor_id) == $doc->id ? 'selected' : '' }}>
                            {{ $doc->doctor_name }} — {{ $doc->specialization }} (Rs. {{ $doc->consultation_fee }})
                        </option>
                    @endforeach
                </select>
                @error('doctor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Date <span class="text-danger">*</span></label>
                <input type="date" name="appointment_date" class="form-control @error('appointment_date') is-invalid @enderror"
                    value="{{ old('appointment_date', $appointment->appointment_date) }}"
                    min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                @error('appointment_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Time <span class="text-danger">*</span></label>
                <select name="appointment_time" class="form-select @error('appointment_time') is-invalid @enderror" required>
                    @foreach(['09:00','09:30','10:00','10:30','11:00','11:30','12:00','14:00','14:30','15:00','15:30','16:00','16:30','17:00'] as $t)
                        <option value="{{ $t }}" {{ old('appointment_time', $appointment->appointment_time) == $t ? 'selected' : '' }}>
                            {{ date('h:i A', strtotime($t)) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label class="form-label fw-bold">Symptoms / Reason</label>
                <textarea name="symptoms" class="form-control" rows="3"
                    placeholder="Describe your symptoms...">{{ old('symptoms', $appointment->symptoms) }}</textarea>
            </div>
            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-success px-5">
                    <i class="fas fa-save me-2"></i>Update Appointment
                </button>
                <a href="{{ route('patient.appointments') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
