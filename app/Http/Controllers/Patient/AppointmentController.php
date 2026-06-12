<?php
namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller {

    public function index() {
        $patient = auth()->user()->patient;
        $appointments = Appointment::with('doctor.user')
            ->where('patient_id', $patient->id)->latest()->get();
        return view('patient.appointments', compact('appointments'));
    }

    public function create() {
        $doctors = Doctor::with('user')->where('is_available', true)->get();
        return view('patient.book_appointment', compact('doctors'));
    }

    public function store(Request $request) {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'symptoms' => 'nullable|string|max:500',
        ], [
            'doctor_id.required' => 'Please select a doctor.',
            'appointment_date.required' => 'Please select an appointment date.',
            'appointment_date.after' => 'Appointment date must be in the future.',
            'appointment_time.required' => 'Please select an appointment time.',
        ]);

        Appointment::create([
            'patient_id' => auth()->user()->patient->id,
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'symptoms' => $request->symptoms,
            'status' => 'pending',
        ]);

        return redirect()->route('patient.appointments')->with('success', 'Appointment booked! Waiting for approval.');
    }

    public function edit($id) {
        $patient = auth()->user()->patient;
        $appointment = Appointment::where('patient_id', $patient->id)->findOrFail($id);

        // Only allow editing if appointment is pending
        if ($appointment->status !== 'pending') {
            return redirect()->route('patient.appointments')->with('error', 'Only pending appointments can be edited.');
        }

        $doctors = Doctor::with('user')->where('is_available', true)->get();
        return view('patient.appointment_edit', compact('appointment', 'doctors'));
    }

    public function update(Request $request, $id) {
        $patient = auth()->user()->patient;
        $appointment = Appointment::where('patient_id', $patient->id)->findOrFail($id);

        if ($appointment->status !== 'pending') {
            return redirect()->route('patient.appointments')->with('error', 'Only pending appointments can be edited.');
        }

        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after:today',
            'appointment_time' => 'required',
            'symptoms' => 'nullable|string|max:500',
        ]);

        $appointment->update([
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'symptoms' => $request->symptoms,
        ]);

        return redirect()->route('patient.appointments')->with('success', 'Appointment updated successfully!');
    }

    public function destroy($id) {
        $patient = auth()->user()->patient;
        $appointment = Appointment::where('patient_id', $patient->id)->findOrFail($id);

        // Only allow deleting pending or rejected appointments
        if (!in_array($appointment->status, ['pending', 'rejected'])) {
            return redirect()->route('patient.appointments')->with('error', 'Only pending or rejected appointments can be deleted.');
        }

        // Delete linked prescription if any
        if ($appointment->prescription) {
            $appointment->prescription->delete();
        }
        $appointment->delete();

        return redirect()->route('patient.appointments')->with('success', 'Appointment deleted successfully.');
    }
}