<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Admin create
        User::create([
            'name' => 'Admin',
            'email' => 'admin@smarthealth.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '03001234567',
        ]);

        // Sample Doctor
        $doctorUser = User::create([
            'name' => 'Dr. Ahmed Ali',
            'email' => 'doctor@smarthealth.com',
            'password' => Hash::make('doctor123'),
            'role' => 'doctor',
            'phone' => '03009876543',
        ]);

        Doctor::create([
            'user_id' => $doctorUser->id,
            'doctor_name' => 'Dr. Ahmed Ali',
            'specialization' => 'Cardiologist',
            'phone' => '03009876543',
            'consultation_fee' => 1500,
            'bio' => 'Experienced cardiologist with 10 years of practice.',
            'experience' => '10 Years',
            'qualification' => 'MBBS, MD Cardiology',
            'is_available' => true,
        ]);
    }
}