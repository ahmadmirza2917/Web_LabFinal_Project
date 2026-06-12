@extends('layouts.dashboard')
@section('title', 'My Profile')

@section('content')
<div class="content-card" style="max-width:600px;margin:0 auto">
    <div class="content-card-header">
        <h5><i class="fas fa-user-cog me-2" style="color:#00d4aa"></i>My Profile</h5>
    </div>

    <div class="text-center mb-4">
        <div style="width:90px;height:90px;background:linear-gradient(135deg,#0f4c75,#00d4aa);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:2rem;margin:0 auto">
            {{ strtoupper(substr($user->name,0,1)) }}
        </div>
    </div>

    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Full Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
        </div>
        <div class="mb-4">
            <label class="form-label fw-bold">Phone</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" required>
            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-success px-5">
            <i class="fas fa-save me-2"></i>Update Profile
        </button>
    </form>
</div>
@endsection