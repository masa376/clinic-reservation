<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ExamTypeSeeder::class,
            MenuSeeder::class,
            DoctorSeeder::class,
            StaffSeeder::class,
            PatientSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}
