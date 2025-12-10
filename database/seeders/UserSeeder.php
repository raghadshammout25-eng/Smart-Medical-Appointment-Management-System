<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'مديرة النظام هبة ',
            'email' => 'engineerheba49@gmail.com',
            'password' => Hash::make('212000'),
            'role' => 'admin', 
        ]);

        User::firstOrCreate([
            'name' => 'دكتور سامر',
            'email' => 'doctor@example.com',
            'password' => Hash::make('password123'),
            'role' => 'doctor',
        ]);

        User::firstOrCreate([
            'name' => 'مريض أحمد',
            'email' => 'patient@example.com',
            'password' => Hash::make('password123'),
            'role' => 'patient',
        ]);
    }
}
