@extends('layouts.dashboard')
@section('title', 'Book Appointment')

@section('content')
<div class="content-card" style="max-width:700px;margin:0 auto">
    <div class="content-card-header">
        <h5><i class="fas fa-calendar-plus me-2" style="color:#00d4aa"></i>Book an Appointment</h5>
    </div>

    <form action="{{ route('patient.appointments.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="form-label fw-bold">Select Doctor <span class="text-danger">*</span></label>
            <select name="doctor_id" class="form-select @error('doctor_id') is-invalid @enderror" required onchange="loadDoctorInfo(this)">
                <option value="">-- Choose a Doctor --</option>
                @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}"
                    data-spec="{{ $doctor->specialization }}"
                    data-fee="{{ $doctor->consultation_fee }}"
                    {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                    {{ $doctor->doctor_name }} - {{ $doctor->specialization }}
                </option>
                @endforeach
            </select>
            @error('doctor_id')<div class="invalid-feedback">{{ $message }}</div>@enderror

            <div id="doctorInfo" class="mt-3 d-none">
                <div style="background:#f0fff9;border:1px solid #00d4aa;border-radius:12px;padding:15px">
                    <span class="badge bg-primary me-2" id="specBadge"></span>
                    <span class="fw-bold text-success" id="feeBadge"></span>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Appointment Date <span class="text-danger">*</span></label>
                <input type="date" name="appointment_date" class="form-control @error('appointment_date') is-invalid @enderror"
                    value="{{ old('appointment_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                @error('appointment_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Preferred Time <span class="text-danger">*</span></label>
                <select name="appointment_time" class="form-select @error('appointment_time') is-invalid @enderror" required>
                    <option value="">Select Time</option>
                    @foreach(['09:00','09:30','10:00','10:30','11:00','11:30','12:00','14:00','14:30','15:00','15:30','16:00','16:30','17:00'] as $t)
                        <option value="{{ $t }}" {{ old('appointment_time')===$t?'selected':'' }}>{{ date('h:i A', strtotime($t)) }}</option>
                    @endforeach
                </select>
                @error('appointment_time')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>

        <div class="mt-3 mb-4">
            <label class="form-label fw-bold">Describe Your Symptoms</label>
            <textarea name="symptoms" class="form-control" rows="3"
                placeholder="e.g. fever since 2 days, headache, sore throat...">{{ old('symptoms') }}</textarea>
        </div>

        <div class="alert" style="background:#fff3cd;border-radius:12px;border:none">
            <i class="fas fa-info-circle me-2"></i>
            Your appointment request will be sent for admin approval. You'll be notified once confirmed.
        </div>

        <button type="submit" class="btn btn-success px-5">
            <i class="fas fa-calendar-check me-2"></i>Book Appointment
        </button>
    </form>
</div>
@endsection

@push('scripts')
<script>
function loadDoctorInfo(sel) {
    const opt = sel.options[sel.selectedIndex];
    const info = document.getElementById('doctorInfo');
    if(sel.value) {
        document.getElementById('specBadge').textContent = opt.dataset.spec;
        document.getElementById('feeBadge').textContent = 'Fee: Rs. ' + parseInt(opt.dataset.fee).toLocaleString();
        info.classList.remove('d-none');
    } else {
        info.classList.add('d-none');
    }
}
</script>
@endpush