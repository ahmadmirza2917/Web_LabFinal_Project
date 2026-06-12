<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DoctorController extends Controller {

    public function dashboard() {
        $doctor = auth()->user()->doctor;
        $stats = [
            'total_appointments' => Appointment::where('doctor_id', $doctor->id)->count(),
            'pending' => Appointment::where('doctor_id', $doctor->id)->where('status','pending')->count(),
            'approved' => Appointment::where('doctor_id', $doctor->id)->where('status','approved')->count(),
            'completed' => Appointment::where('doctor_id', $doctor->id)->where('status','completed')->count(),
        ];
        $recent = Appointment::with('patient.user')->where('doctor_id', $doctor->id)->latest()->take(5)->get();
        return view('doctor.dashboard', compact('stats', 'recent', 'doctor'));
    }

    public function appointments() {
        $doctor = auth()->user()->doctor;
        $appointments = Appointment::with('patient.user')
            ->where('doctor_id', $doctor->id)->latest()->get();
        return view('doctor.appointments', compact('appointments'));
    }

    public function profile() {
        $doctor = auth()->user()->doctor;
        return view('doctor.profile', compact('doctor'));
    }

    public function updateProfile(Request $request) {
        $request->validate([
            'doctor_name' => 'required|string|max:100',
            'phone' => 'required|string|max:15',
            'bio' => 'nullable|string|max:1000',
        ]);
        auth()->user()->doctor->update($request->only('doctor_name','phone','bio','experience','qualification'));
        auth()->user()->update(['name' => $request->doctor_name, 'phone' => $request->phone]);
        return back()->with('success', 'Profile updated!');
    }

    public function updatePassword(Request $request) {
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
}