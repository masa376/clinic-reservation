<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ExamTypeSeeder::class,
            MenuSeeder::class,
            DoctorSeeder::class,
            StaffSeeder::class,
            PatientSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}
