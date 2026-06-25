<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $reservations = [
            [
                'patient_id'  => 1,
                'doctor_id'   => 1,
                'staff_id'    => 1,
                'menu_id'     => 1,
                'reserved_at' => now()->format('Y-m-d') . ' 09:00:00',
                'status'      => 'confirmed',
                'memo'        => null,
            ],
            [
                'patient_id'  => 2,
                'doctor_id'   => 1,
                'staff_id'    => 1,
                'menu_id'     => 3,
                'reserved_at' => now()->format('Y-m-d') . ' 10:00:00',
                'status'      => 'confirmed',
                'memo'        => 'ヨード造影剤アレルギーあり。非イオン性造影剤を使用すること。',
            ],
            [
                'patient_id'  => 3,
                'doctor_id'   => 2,
                'staff_id'    => 2,
                'menu_id'     => 6,
                'reserved_at' => now()->format('Y-m-d') . ' 11:00:00',
                'status'      => 'pending',
                'memo'        => null,
            ],
            [
                'patient_id'  => 4,
                'doctor_id'   => 1,
                'staff_id'    => 1,
                'menu_id'     => 8,
                'reserved_at' => now()->format('Y-m-d') . ' 13:00:00',
                'status'      => 'confirmed',
                'memo'        => '金属アレルギーあり。事前確認済み',
            ],
            [
                'patient_id'  => 5,
                'doctor_id'   => 3,
                'staff_id'    => 3,
                'menu_id'     => 5,
                'reserved_at' => now()->format('Y-m-d') . ' 14:00:00',
                'status'      => 'pending',
                'memo'        => null,
            ],
            [
                'patient_id'  => 6,
                'doctor_id'   => 2,
                'staff_id'    => 2,
                'menu_id'     => 2,
                'reserved_at' => now()->format('Y-m-d') . ' 15:00:00',
                'status'      => 'confirmed',
                'memo'        => null,
            ],
            [
                'patient_id'  => 1,
                'doctor_id'   => 1,
                'staff_id'    => 1,
                'menu_id'     => 4,
                'reserved_at' => now()->subDay()->format('Y-m-d') . ' 10:00:00',
                'status'      => 'done',
                'memo'        => '検査完了。異常なし。',
            ],
            [
                'patient_id'  => 8,
                'doctor_id'   => 4,
                'staff_id'    => 2,
                'menu_id'     => 8,
                'reserved_at' => now()->subDay()->format('Y-m-d') . ' 14:00:00',
                'status'      => 'done',
                'memo'        => null,
            ],
            [
                'patient_id'  => 3,
                'doctor_id'   => 2,
                'staff_id'    => 3,
                'menu_id'     => 7,
                'reserved_at' => now()->addDay()->format('Y-m-d') . ' 09:00:00',
                'status'      => 'pending',
                'memo'        => null,
            ],
            [
                'patient_id'  => 6,
                'doctor_id'   => 1,
                'staff_id'    => 1,
                'menu_id'     => 3,
                'reserved_at' => now()->addDay()->format('Y-m-d') . ' 11:00:00',
                'status'      => 'confirmed',
                'memo'        => null,
            ],
        ];

        foreach ($reservations as $reservation) {
            Reservation::create($reservation);
        }
    }
}
