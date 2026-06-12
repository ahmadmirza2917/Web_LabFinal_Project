@extends('layouts.app')
@section('title', 'Home')

@push('styles')
<style>
.hero {
    min-height:92vh; background:linear-gradient(135deg,#0a2540 0%,#0f4c75 60%,#1b6ca8 100%);
    display:flex; align-items:center; position:relative; overflow:hidden;
}
.hero::before {
    content:''; position:absolute; width:600px; height:600px; background:radial-gradient(circle,rgba(0,212,170,0.15) 0%,transparent 70%);
    border-radius:50%; top:-100px; right:-100px; animation:float 6s ease-in-out infinite;
}
.hero::after {
    content:''; position:absolute; width:400px; height:400px; background:radial-gradient(circle,rgba(0,212,170,0.1) 0%,transparent 70%);
    border-radius:50%; bottom:-50px; left:100px; animation:float 8s ease-in-out infinite reverse;
}
@keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-20px)}}

.hero-title {
    font-family:'Playfair Display',serif; font-size:3.5rem; color:#fff; line-height:1.2;
    animation:fadeInUp 0.8s ease;
}
.hero-title span { color:#00d4aa; }
@keyframes fadeInUp{from{opacity:0;transform:translateY(30px)}to{opacity:1;transform:translateY(0)}}

.hero-sub { color:rgba(255,255,255,0.8); font-size:1.1rem; margin:20px 0 35px; animation:fadeInUp 0.8s ease 0.2s both; }
.hero-btns { animation:fadeInUp 0.8s ease 0.4s both; }
.btn-hero-primary {
    background:var(--accent); color:#fff; border-radius:50px; padding:14px 35px;
    font-weight:700; border:none; font-size:1rem; transition:all 0.3s; margin-right:15px;
}
.btn-hero-primary:hover { transform:translateY(-3px); box-shadow:0 10px 30px rgba(0,212,170,0.4); color:#fff; }
.btn-hero-outline {
    border:2px solid rgba(255,255,255,0.5); color:#fff; border-radius:50px; padding:14px 35px;
    font-weight:700; background:transparent; font-size:1rem; transition:all 0.3s; text-decoration:none; display:inline-block;
}
.btn-hero-outline:hover { background:rgba(255,255,255,0.1); color:#fff; transform:translateY(-3px); }

.stat-bubble {
    background:rgba(255,255,255,0.1); backdrop-filter:blur(10px); border:1px solid rgba(255,255,255,0.2);
    border-radius:16px; padding:20px; color:#fff; text-align:center;
    animation:fadeInUp 0.8s ease 0.6s both;
}
.stat-bubble .number { font-size:2rem; font-weight:800; color:#00d4aa; }

.feature-card {
    background:#fff; border-radius:20px; padding:35px; text-align:center;
    box-shadow:0 4px 20px rgba(0,0,0,0.06); transition:all 0.3s;
    border-bottom:4px solid transparent;
}
.feature-card:hover { transform:translateY(-8px); box-shadow:0 15px 40px rgba(0,0,0,0.12); border-bottom-color:#00d4aa; }
.feature-icon {
    width:75px; height:75px; border-radius:20px; display:flex; align-items:center;
    justify-content:center; font-size:1.8rem; margin:0 auto 20px;
}

.doctor-card {
    background:#fff; border-radius:18px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.06);
    transition:all 0.3s;
}
.doctor-card:hover { transform:translateY(-6px); box-shadow:0 15px 40px rgba(0,0,0,0.12); }
.doctor-card .doc-header {
    background:linear-gradient(135deg,#0f4c75,#1b6ca8); padding:30px; text-align:center;
}
.doctor-avatar {
    width:80px; height:80px; background:rgba(255,255,255,0.2); border-radius:50%;
    display:flex; align-items:center; justify-content:center; font-size:2rem;
    font-weight:700; color:#fff; margin:0 auto 10px; border:3px solid rgba(255,255,255,0.4);
}

.section-badge {
    background:#f0fff9; color:#00d4aa; border-radius:50px; padding:8px 20px;
    font-weight:700; font-size:0.85rem; display:inline-block; margin-bottom:15px;
}
</style>
@endpush

@section('content')
<!-- HERO -->
<section class="hero">
    <div class="container position-relative" style="z-index:2">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1 class="hero-title">Your Health, Our<br><span>Priority Always</span></h1>
                <p class="hero-sub">AI-powered hospital management system connecting patients with top specialists. Book appointments, get AI health insights, and manage your healthcare digitally.</p>
                <div class="hero-btns">
                    <a href="{{ route('register') }}" class="btn-hero-primary">
                        <i class="fas fa-user-plus me-2"></i>Get Started Free
                    </a>
                    <a href="{{ route('doctors') }}" class="btn-hero-outline">
                        <i class="fas fa-search me-2"></i>Find Doctors
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="row g-3 mt-3">
                    <div class="col-6">
                        <div class="stat-bubble">
                            <div class="number">50+</div>
                            <div>Specialist Doctors</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-bubble" style="animation-delay:0.8s">
                            <div class="number">1000+</div>
                            <div>Happy Patients</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-bubble" style="animation-delay:1s">
                            <div class="number">AI</div>
                            <div>Symptom Checker</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-bubble" style="animation-delay:1.2s">
                            <div class="number">24/7</div>
                            <div>Health Chatbot</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="py-5" style="background:#f0f8ff">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="section-badge"><i class="fas fa-star me-1"></i>Our Features</span>
            <h2 class="fw-800" style="font-family:'Playfair Display',serif;color:#0f4c75">Everything You Need</h2>
        </div>
        <div class="row g-4">
            @foreach([
                ['icon'=>'fa-robot','color'=>'linear-gradient(135deg,#0f4c75,#1b6ca8)','title'=>'AI Symptom Checker','desc'=>'Describe your symptoms and get AI-powered health condition suggestions and specialist recommendations.'],
                ['icon'=>'fa-calendar-check','color'=>'linear-gradient(135deg,#00d4aa,#00b891)','title'=>'Easy Appointments','desc'=>'Book appointments with available specialists in seconds. Track approval status in real-time.'],
                ['icon'=>'fa-prescription-bottle-alt','color'=>'linear-gradient(135deg,#6c63ff,#4c44d4)','title'=>'Digital Prescriptions','desc'=>'Doctors issue digital prescriptions. Get AI-powered explanations in simple language.'],
                ['icon'=>'fa-heart-pulse','color'=>'linear-gradient(135deg,#e74c3c,#c0392b)','title'=>'Health Risk Assessment','desc'=>'Enter your vitals and get AI-based health risk analysis — Low, Medium, or High.'],
                ['icon'=>'fa-comments','color'=>'linear-gradient(135deg,#f39c12,#e67e22)','title'=>'Health Chatbot','desc'=>'24/7 AI health assistant to answer your health questions and guide you through the platform.'],
                ['icon'=>'fa-shield-alt','color'=>'linear-gradient(135deg,#2ecc71,#27ae60)','title'=>'Secure & Private','desc'=>'Role-based access control ensures your health data is safe and only visible to authorized users.'],
            ] as $f)
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon" style="background:{{ $f['color'] }}">
                        <i class="fas {{ $f['icon'] }} text-white"></i>
                    </div>
                    <h5 class="fw-bold" style="color:#0f4c75">{{ $f['title'] }}</h5>
                    <p class="text-muted mb-0">{{ $f['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- DOCTORS -->
<section class="py-5">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="section-badge"><i class="fas fa-user-md me-1"></i>Our Team</span>
            <h2 class="fw-800" style="font-family:'Playfair Display',serif;color:#0f4c75">Meet Our Specialists</h2>
        </div>
        <div class="row g-4">
            @forelse($doctors as $doctor)
            <div class="col-md-4">
                <div class="doctor-card">
                    <div class="doc-header">
                        <div class="doctor-avatar">{{ strtoupper(substr($doctor->doctor_name,0,1)) }}</div>
                        <h5 class="text-white mb-1">{{ $doctor->doctor_name }}</h5>
                        <span class="badge" style="background:rgba(0,212,170,0.3);color:#fff">{{ $doctor->specialization }}</span>
                    </div>
                    <div class="p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted"><i class="fas fa-briefcase me-1"></i>{{ $doctor->experience ?? 'Experienced' }}</span>
                            <span class="fw-bold text-success">Rs. {{ number_format($doctor->consultation_fee) }}</span>
                        </div>
                        <p class="text-muted small mb-3">{{ Str::limit($doctor->bio ?? 'Experienced specialist ready to help you.', 80) }}</p>
                        <a href="{{ route('register') }}" class="btn btn-success w-100 rounded-pill">
                            <i class="fas fa-calendar-plus me-2"></i>Book Appointment
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted">No doctors available at the moment.</div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('doctors') }}" class="btn btn-outline-primary rounded-pill px-5">View All Doctors</a>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5" style="background:linear-gradient(135deg,#0a2540,#0f4c75)">
    <div class="container py-3 text-center">
        <h2 style="font-family:'Playfair Display',serif;color:#fff;font-size:2.5rem">Ready to Take Control of Your Health?</h2>
        <p style="color:rgba(255,255,255,0.8)" class="mt-3 mb-4 fs-5">Join thousands of patients managing their health digitally.</p>
        <a href="{{ route('register') }}" class="btn-hero-primary" style="text-decoration:none">
            <i class="fas fa-rocket me-2"></i>Start for Free Today
        </a>
    </div>
</section>
@endsection