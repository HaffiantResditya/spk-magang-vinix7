<?php

namespace Database\Seeders;

use App\Models\ApplicantProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin (Gmail)
        User::updateOrCreate(
            ['email' => 'superadmin.vinix7@gmail.com'],
            [
                'name' => 'Super Admin Vinix7',
                'password' => Hash::make('password'),
                'role' => 'superadmin',
            ]
        );

        // HRD (Gmail)
        User::updateOrCreate(
            ['email' => 'hrd.vinix7@gmail.com'],
            [
                'name' => 'Admin HRD Vinix7',
                'password' => Hash::make('password'),
                'role' => 'hrd',
            ]
        );

        // Pelamar Test (Gmail)
        $applicant = User::updateOrCreate(
            ['email' => 'pelamar.vinix7@gmail.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role' => 'applicant',
            ]
        );

        ApplicantProfile::updateOrCreate(
            ['user_id' => $applicant->id],
            [
                'type' => 'mahasiswa',
                'institution' => 'Universitas Indonesia',
                'phone' => '081234567890',
                'cv_path' => null,
            ]
        );
    }
}
