<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            // X線検査（exam_type_id：1）
            [
                'exam_type_id'     => 1,
                'name'             => '胸部X線撮影',
                'duration_minutes' => 15,
                'price'            => 3000,
            ],
            [
                'exam_type_id'     => 1,
                'name'             => '腹部X線撮影',
                'duration_minutes' => 15,
                'price'            => 3000,
            ],

            // CT検査（exam_type_id：2）
            [
                'exam_type_id'     => 2,
                'name'             => '胸部CT',
                'duration_minutes' => 30,
                'price'            => 15000,
            ],
            [
                'exam_type_id'     => 2,
                'name'             => '腹部CT',
                'duration_minutes' => 30,
                'price'            => 15000,
            ],

            // MRI検査（exam_type_id：3）
            [
                'exam_type_id'     => 3,
                'name'             => '頭部MRI',
                'duration_minutes' => 45,
                'price'            => 20000,
            ],
            [
                'exam_type_id'     => 3,
                'name'             => '腰椎MRI',
                'duration_minutes' => 45,
                'price'            => 20000,
            ],

            // エコー検査（exam_type_id：4）
            [
                'exam_type_id'     => 4,
                'name'             => '腹部エコー',
                'duration_minutes' => 20,
                'price'            => 5000,
            ],
            [
                'exam_type_id'     => 4,
                'name'             => '心臓エコー',
                'duration_minutes' => 30,
                'price'            => 8000,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
