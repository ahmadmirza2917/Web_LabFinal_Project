<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorManageController extends Controller {

    public function index() {
        $doctors = Doctor::with('user')->latest()->get();
        return view('admin.doctors.index', compact('doctors'));
    }

    public function create() {
        return view('admin.doctors.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'doctor_name' => 'required|string|max:100',
            'specialization' => 'required|string|max:100',
            'phone' => 'required|string|max:15',
            'consultation_fee' => 'required|numeric|min:0',
            'experience' => 'nullable|string|max:50',
            'qualification' => 'nullable|string|max:200',
            'bio' => 'nullable|string|max:1000',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'doctor',
            'phone' => $request->phone,
        ]);

        Doctor::create([
            'user_id' => $user->id,
            'doctor_name' => $request->doctor_name,
            'specialization' => $request->specialization,
            'phone' => $request->phone,
            'consultation_fee' => $request->consultation_fee,
            'experience' => $request->experience,
            'qualification' => $request->qualification,
            'bio' => $request->bio,
            'is_available' => $request->has('is_available') ? 1 : 1, // default available
        ]);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor added successfully!');
    }

    public function edit(Doctor $doctor) {
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor) {
        $request->validate([
            'doctor_name' => 'required|string|max:100',
            'specialization' => 'required|string|max:100',
            'phone' => 'required|string|max:15',
            'consultation_fee' => 'required|numeric|min:0',
        ]);

        $doctor->update([
            'doctor_name' => $request->doctor_name,
            'specialization' => $request->specialization,
            'phone' => $request->phone,
            'consultation_fee' => $request->consultation_fee,
            'experience' => $request->experience,
            'qualification' => $request->qualification,
            'bio' => $request->bio,
            'is_available' => $request->has('is_available') ? 1 : 0,
        ]);
        $doctor->user->update(['name' => $request->doctor_name, 'phone' => $request->phone]);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully!');
    }

    public function destroy(Doctor $doctor) {
        $doctor->user->delete();
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted successfully!');
    }

    public function show(Doctor $doctor) {
        return view('admin.doctors.show', compact('doctor'));
    }
}