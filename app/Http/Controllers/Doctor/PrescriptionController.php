<?php
namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\Appointment;
use Illuminate\Http\Request;

class PrescriptionController extends Controller {

    public function index() {
        $doctor = auth()->user()->doctor;
        $prescriptions = Prescription::with('patient.user', 'appointment')
            ->where('doctor_id', $doctor->id)->latest()->get();
        return view('doctor.prescriptions.index', compact('prescriptions'));
    }

    public function create($appointment_id) {
        $appointment = Appointment::with('patient.user')->findOrFail($appointment_id);
        return view('doctor.prescriptions.create', compact('appointment'));
    }

    public function store(Request $request) {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'diagnosis' => 'required|string',
            'medicines' => 'required|string',
            'instructions' => 'nullable|string',
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);
        Prescription::create([
            'appointment_id' => $request->appointment_id,
            'doctor_id' => auth()->user()->doctor->id,
            'patient_id' => $appointment->patient_id,
            'diagnosis' => $request->diagnosis,
            'medicines' => $request->medicines,
            'instructions' => $request->instructions,
            'prescription_date' => now()->toDateString(),
        ]);
        $appointment->update(['status' => 'completed']);

        return redirect()->route('doctor.prescriptions')->with('success', 'Prescription created!');
    }

    public function show($id) {
        $prescription = Prescription::with('patient.user', 'doctor.user', 'appointment')->findOrFail($id);
        return view('doctor.prescriptions.show', compact('prescription'));
    }

    public function edit($id) {
        $prescription = Prescription::with('appointment.patient.user')->findOrFail($id);
        // Ensure this prescription belongs to this doctor
        if ($prescription->doctor_id !== auth()->user()->doctor->id) {
            abort(403);
        }
        return view('doctor.prescriptions.edit', compact('prescription'));
    }

    public function update(Request $request, $id) {
        $prescription = Prescription::findOrFail($id);
        if ($prescription->doctor_id !== auth()->user()->doctor->id) {
            abort(403);
        }
        $request->validate([
            'diagnosis' => 'required|string',
            'medicines' => 'required|string',
            'instructions' => 'nullable|string',
            'symptoms' => 'nullable|string|max:500',
        ]);
        $prescription->update([
            'diagnosis' => $request->diagnosis,
            'medicines' => $request->medicines,
            'instructions' => $request->instructions,
        ]);
        // Update appointment symptoms if provided
        if ($request->filled('symptoms')) {
            $prescription->appointment->update(['symptoms' => $request->symptoms]);
        }
        return redirect()->route('doctor.prescriptions.show', $prescription->id)->with('success', 'Prescription updated!');
    }
}