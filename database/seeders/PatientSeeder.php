<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'patient@example.com')->first();

        Patient::create([
            'user_id' => $user->id,
            'birth_date' => '1995-06-15',
            'gender' => 'male',
            'phone' => '0988888888',
            'address' => 'حلب - شارع النيل',
        ]);
    }
}
