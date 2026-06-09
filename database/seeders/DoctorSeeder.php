<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            [
                'name'      => '山田 太郎',
                'specialty' => '放射線科',
                'phone'     => '090-1234-5678',
                'email'     => 'yamada@clinic.example.com',
            ],
            [
                'name'      => '佐藤 花子',
                'specialty' => '内科',
                'phone'     => '090-2345-6789',
                'email'     => 'sato@clinic.example.com',
            ],
            [
                'name'      => '鈴木 一郎',
                'specialty' => '外科',
                'phone'     => '090-3456-7890',
                'email'     => 'suzuki@clinic.example.com',
            ],
            [
                'name'      => '田中 美咲',
                'specialty' => '神経内科',
                'phone'     => '090-4567-8901',
                'email'     => 'tanaka@clinic.example.com',
            ]
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}
