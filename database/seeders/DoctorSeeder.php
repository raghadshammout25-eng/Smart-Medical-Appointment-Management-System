<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
         $user = User::where('email', 'doctor@example.com')->first();

        Doctor::create([
            'user_id' => $user->id,
            'specialty' => 'أعصاب',
            'license_number' => 'DOC123456',
            'phone' => '0999999999',
        ]);
    
    }
}

