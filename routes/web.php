<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DoctorManageController;
use App\Http\Controllers\Admin\AppointmentManageController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Doctor\PrescriptionController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Patient\AppointmentController;
use App\Http\Controllers\AiController;
use App\Http\Controllers\PublicController;

// Redirect root to login
Route::get('/', function () {
    if (Auth::check()) {
        return match(Auth::user()->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'doctor' => redirect()->route('doctor.dashboard'),
            'patient' => redirect()->route('patient.dashboard'),
            default => redirect()->route('login'),
        };
    }
    return redirect()->route('login');
})->name('home');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');

    // Doctor Management
    Route::resource('doctors', DoctorManageController::class);

    // Appointment Management
    Route::get('/appointments', [AppointmentManageController::class, 'index'])->name('appointments');
    Route::post('/appointments/{id}/approve', [AppointmentManageController::class, 'approve'])->name('appointments.approve');
    Route::post('/appointments/{id}/reject', [AppointmentManageController::class, 'reject'])->name('appointments.reject');

    // Patients
    Route::get('/patients', [AdminController::class, 'patients'])->name('patients');
    Route::delete('/patients/{id}', [AdminController::class, 'deletePatient'])->name('patients.destroy');

    // Admin Appointment delete
    Route::delete('/appointments/{id}', [AppointmentManageController::class, 'destroy'])->name('appointments.destroy');
});

// Doctor Routes
Route::prefix('doctor')->name('doctor.')->middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/dashboard', [DoctorController::class, 'dashboard'])->name('dashboard');
    Route::get('/appointments', [DoctorController::class, 'appointments'])->name('appointments');
    Route::get('/profile', [DoctorController::class, 'profile'])->name('profile');
    Route::post('/profile', [DoctorController::class, 'updateProfile'])->name('profile.update');
    Route::post('/change-password', [DoctorController::class, 'updatePassword'])->name('password.update');

    // Prescriptions
    Route::get('/prescriptions', [PrescriptionController::class, 'index'])->name('prescriptions');
    Route::get('/prescriptions/create/{appointment}', [PrescriptionController::class, 'create'])->name('prescriptions.create');
    Route::post('/prescriptions', [PrescriptionController::class, 'store'])->name('prescriptions.store');
    Route::get('/prescriptions/{id}', [PrescriptionController::class, 'show'])->name('prescriptions.show');
    Route::get('/prescriptions/{id}/edit', [PrescriptionController::class, 'edit'])->name('prescriptions.edit');
    Route::put('/prescriptions/{id}', [PrescriptionController::class, 'update'])->name('prescriptions.update');
});

// Patient Routes
Route::prefix('patient')->name('patient.')->middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/dashboard', [PatientController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [PatientController::class, 'profile'])->name('profile');
    Route::post('/profile', [PatientController::class, 'updateProfile'])->name('profile.update');

    // Appointments
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments');
    Route::get('/appointments/book', [AppointmentController::class, 'create'])->name('appointments.book');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
    Route::put('/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
    Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

    // Account Settings
    Route::post('/change-password', [PatientController::class, 'changePassword'])->name('password.update');
    Route::post('/change-email', [PatientController::class, 'changeEmail'])->name('email.update');

    // Prescriptions
    Route::get('/prescriptions', [PatientController::class, 'prescriptions'])->name('prescriptions');
    Route::get('/prescriptions/{id}', [PatientController::class, 'showPrescription'])->name('prescriptions.show');

    // AI Features
    Route::get('/ai/symptom-checker', [AiController::class, 'symptomChecker'])->name('ai.symptom');
    Route::post('/ai/symptom-checker', [AiController::class, 'checkSymptoms'])->name('ai.symptom.check');
    Route::get('/ai/chatbot', [AiController::class, 'chatbot'])->name('ai.chatbot');
    Route::post('/ai/chatbot', [AiController::class, 'chat'])->name('ai.chat');
    Route::get('/ai/health-risk', [AiController::class, 'healthRisk'])->name('ai.health_risk');
    Route::post('/ai/health-risk', [AiController::class, 'assessRisk'])->name('ai.health_risk.assess');
    Route::post('/ai/explain-prescription/{id}', [AiController::class, 'explainPrescription'])->name('ai.explain_prescription');
});