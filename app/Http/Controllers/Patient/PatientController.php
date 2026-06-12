<?php
namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PatientController extends Controller {

    public function dashboard() {
        $patient = auth()->user()->patient;
        $stats = [
            'total_appointments' => Appointment::where('patient_id', $patient->id)->count(),
            'pending' => Appointment::where('patient_id', $patient->id)->where('status','pending')->count(),
            'approved' => Appointment::where('patient_id', $patient->id)->where('status','approved')->count(),
            'prescriptions' => Prescription::where('patient_id', $patient->id)->count(),
        ];
        $recent = Appointment::with('doctor.user')
            ->where('patient_id', $patient->id)->latest()->take(5)->get();
        return view('patient.dashboard', compact('stats', 'recent', 'patient'));
    }

    public function profile() {
        $patient = auth()->user()->patient;
        return view('patient.profile', compact('patient'));
    }

    public function updateProfile(Request $request) {
        $request->validate([
            'patient_name' => 'required|string|max:100',
            'phone' => 'required|string|max:15',
            'blood_group' => 'nullable|string|max:5',
            'weight' => 'nullable|numeric',
            'blood_pressure' => 'nullable|string|max:20',
            'blood_sugar' => 'nullable|string|max:20',
        ]);
        auth()->user()->patient->update($request->only('patient_name','phone','blood_group','weight','blood_pressure','blood_sugar','address','gender','date_of_birth'));
        auth()->user()->update(['name' => $request->patient_name, 'phone' => $request->phone]);
        return back()->with('success', 'Profile updated!');
    }

    public function prescriptions() {
        $patient = auth()->user()->patient;
        $prescriptions = Prescription::with('doctor.user')
            ->where('patient_id', $patient->id)->latest()->get();
        return view('patient.prescriptions', compact('prescriptions'));
    }

    public function showPrescription($id) {
        $prescription = Prescription::with('doctor.user','patient.user','appointment')->findOrFail($id);
        return view('patient.prescription_detail', compact('prescription'));
    }

    public function changePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
        if (!\Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
        auth()->user()->update(['password' => \Hash::make($request->password)]);
        return back()->with('success', 'Password changed successfully!');
    }

    public function changeEmail(Request $request) {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'current_password' => 'required',
        ]);
        if (!\Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'Password is incorrect.']);
        }
        auth()->user()->update(['email' => $request->email]);
        return back()->with('success', 'Email updated successfully!');
    }
}