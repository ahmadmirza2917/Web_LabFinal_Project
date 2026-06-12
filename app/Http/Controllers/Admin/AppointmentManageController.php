<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;

class AppointmentManageController extends Controller {

    public function index() {
        $appointments = Appointment::with(['patient.user', 'doctor.user'])->latest()->get();
        return view('admin.appointments', compact('appointments'));
    }

    public function approve($id) {
        Appointment::findOrFail($id)->update(['status' => 'approved']);
        return back()->with('success', 'Appointment approved!');
    }

    public function reject($id) {
        Appointment::findOrFail($id)->update(['status' => 'rejected']);
        return back()->with('success', 'Appointment rejected!');
    }

    public function destroy($id) {
        $appointment = Appointment::findOrFail($id);
        // Delete linked prescription if any
        if ($appointment->prescription) {
            $appointment->prescription->delete();
        }
        $appointment->delete();
        return back()->with('success', 'Appointment deleted successfully.');
    }
}