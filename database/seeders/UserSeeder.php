<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [

            // 管理者
            [
                'name'     => '管理者',
                'email'    => 'admin@clinic.example.com',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ],

            // スタッフ（StaffSeederの伊藤・渡辺に対応）
            [
                'name'     => '伊藤 健太',
                'email'    => 'ito@clinic.example.com',
                'password' => Hash::make('password'),
                'role'     => 'staff',
            ],
            [
                'name'     => '渡辺 さくら',
                'email'    => 'watanabe@clinic.example.com',
                'password' => Hash::make('password'),
                'role'     => 'staff',
            ],

            // 医師（DockerSeederの山田・佐藤に対応）
            [
                'name'     => '山田 太郎',
                'email'    => 'yamada@clinic.example.com',
                'password' => Hash::make('password'),
                'role'     => 'doctor',
            ],
            [
                'name'     => '佐藤 花子',
                'email'    => 'sato@clinic.example.com',
                'password' => Hash::make('password'),
                'role'     => 'doctor',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
