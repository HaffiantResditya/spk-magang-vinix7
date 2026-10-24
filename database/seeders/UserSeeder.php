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
        // Super Admin
        User::firstOrCreate(
            ['email' => 'superadmin@vinix.id'],
            [
                'name' => 'Super Admin Vinix7',
                'password' => Hash::make('password'),
                'role' => 'superadmin',
            ]
        );

        // HRD
        User::firstOrCreate(
            ['email' => 'hrd@vinix.id'],
            [
                'name' => 'Admin HRD Vinix7',
                'password' => Hash::make('password'),
                'role' => 'hrd',
            ]
        );

        // Pelamar Test
        $applicant = User::firstOrCreate(
            ['email' => 'pelamar@vinix.id'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role' => 'applicant',
            ]
        );

        ApplicantProfile::firstOrCreate(
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
