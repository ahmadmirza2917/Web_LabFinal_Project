<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller {

    public function dashboard() {
        $stats = [
            'total_doctors' => Doctor::count(),
            'total_patients' => Patient::count(),
            'total_appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'approved_appointments' => Appointment::where('status', 'approved')->count(),
            'rejected_appointments' => Appointment::where('status', 'rejected')->count(),
        ];
        $recent_appointments = Appointment::with(['patient.user', 'doctor.user'])
            ->latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'recent_appointments'));
    }

    public function patients() {
        $patients = Patient::with('user')->latest()->get();
        return view('admin.patients', compact('patients'));
    }

    public function deletePatient($id) {
        $patient = Patient::findOrFail($id);
        // Delete user (cascades to patient, appointments via DB or manual)
        Appointment::where('patient_id', $patient->id)->delete();
        $patient->user->delete();
        return redirect()->route('admin.patients')->with('success', 'Patient deleted successfully.');
    }

    public function profile() {
        return view('admin.profile', ['user' => auth()->user()]);
    }

    public function updateProfile(Request $request) {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:15',
        ]);
        auth()->user()->update($request->only('name', 'phone'));
        return back()->with('success', 'Profile updated successfully.');
    }
}