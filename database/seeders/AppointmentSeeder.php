<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        // نجيب المستخدمين المرتبطين بالدكتور والمريض
        $doctorUser = User::where('email', 'doctor@example.com')->first();
        $patientUser = User::where('email', 'patient@example.com')->first();

        // نجيب الدكتور والمريض المرتبطين بهالمستخدمين
        $doctor = Doctor::where('user_id', $doctorUser->id)->first();
        $patient = Patient::where('user_id', $patientUser->id)->first();

        // نضيف الموعد
        Appointment::create([
            'doctor_id' => $doctor->doctor_id,
            'patient_id' => $patient->patient_id,
            'appointment_date' => now()->addDays(1)->toDateString(),
            'appointment_time' => '10:00:00',
            'status' => 'scheduled',
            'notes' => 'مراجعة أولى',
        ]);
    }
}
