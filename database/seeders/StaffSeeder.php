<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        $staffs = [
            [
                'name'  => '伊藤 健太',
                'role'  => '放射線技師',
                'phone' => '090-5678-9012',
                'email' => 'ito@clinic.example.com',
            ],
            [
                'name'  => '渡辺 さくら',
                'role'  => '放射線技師',
                'phone' => '090-6789-0123',
                'email' => 'watanabe@clinic.example.com',
            ],
            [
                'name'  => '中村 陽子',
                'role'  => '看護師',
                'phone' => '090-7890-1234',
                'email' => 'kobayashi@clinic.example.com',
            ],
            [
                'name'  => '加藤 明美',
                'role'  => '受付',
                'phone' => '090-9012-3456',
                'email' => 'kato@clinic.example.com',
            ],
        ];

        foreach ($staffs as $staff) {
            Staff::create($staff);
        }
    }
}
