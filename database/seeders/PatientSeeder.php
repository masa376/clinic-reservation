<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            [
                'name'          => '高橋 直樹',
                'name_kana'     => 'タカハシ ナオキ',
                'birth_date'    => '1975-04-15',
                'gender'        => 'male',
                'phone'         => '090-1111-2222',
                'email'         => 'takahashi@example.com',
                'allergy_notes' => null,
            ],
            [
                'name'          => '松本 由美',
                'name_kana'     => 'マツモト ユミ',
                'birth_date'    => '1982-08-22',
                'gender'        => 'female',
                'phone'         => '090-2222-3333',
                'email'         => 'matsumoto@example.com',
                'allergy_notes' => 'ヨード造影剤アレルギーあり（過去に蕁麻疹）',
            ],
            [
                'name'          => '井上 修',
                'name_kana'     => 'イノウエ オサム',
                'birth_date'    => '1968-12-03',
                'gender'        => 'male',
                'phone'         => '090-3333-4444',
                'email'         => null,
                'allergy_notes' => null,
            ],
            [
                'name'          => '木村 恵子',
                'name_kana'     => 'キムラ ケイコ',
                'birth_date'    => '1990-06-18',
                'gender'        => 'female',
                'phone'         => '090-4444-5555',
                'email'         => 'kimura@example.com',
                'allergy_notes' => '金属アレルギー（ニッケル）',
            ],
            [
                'name'          => '清水 大輔',
                'name_kana'     => 'シミズ ダイスケ',
                'birth_date'    => '1955-02-28',
                'gender'        => 'male',
                'phone'         => '090-5555-6666',
                'email'         => null,
                'allergy_notes' => null,
            ],
            [
                'name'          => '山口 美穂',
                'name_kana'     => 'ヤマグチ ミホ',
                'birth_date'    => '2000-10-10',
                'gender'        => 'female',
                'phone'         => '090-6666-7777',
                'email'         => 'yamaguchi@example.com',
                'allergy_notes' => null,
            ],
            [
                'name'          => '森 義雄',
                'name_kana'     => 'モリ ヨシオ',
                'birth_date'    => '1948-07-07',
                'gender'        => 'male',
                'phone'         => '090-7777-8888',
                'email'         => null,
                'allergy_notes' => 'ペースメーカー装着中・MRI検査不可',
            ],
            [
                'name'          => '池田 千夏',
                'name_kana'     => 'イケダ チナツ',
                'birth_date'    => '1995-03-25',
                'gender'        => 'female',
                'phone'         => '090-8888-9999',
                'email'         => 'ikeda@example.com',
                'allergy_notes' => null,
            ],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}
