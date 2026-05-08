<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ExamType;
use Illuminate\Database\Seeder;

class ExamTypeSeeder extends Seeder
{
    public function run(): void
    {
        $examTypes = [
            [
                'name'              => 'X線検査',
                'description'       => 'X線を使って体内を撮影する検査です。骨や肺の状態を確認します。',
                'preparation_notes' => "・金属類（アクセサリー・ベルト等）は外してください\n・妊娠中の方は事前にお申し出ください",
            ],
            [
                'name'              => 'CT検査',
                'description'       => 'X線を使って体を輪切りにした断面画像を撮影する検査です。',
                'preparation_notes' => "・造影剤を使用する場合は検査4時間前から絶食\n・アレルギーがある方は事前にお申し出ください\n・金属類は外してください",
            ],
            [
                'name'              => 'MRI検査',
                'description'       => '磁気と電波を使って体内を撮影する検査です。放射線は使用しません。',
                'preparation_notes' => "・金属類・磁気カードは必ず外してください\n・ペースメーカーをお持ちの方は事前にご相談ください\n・閉所恐怖症の方はお申し出ください",
            ],
            [
                'name'              => 'エコー検査',
                'description'       => '超音波を使って体内の臓器を観察する検査です。痛みはありません。',
                'preparation_notes' => "・腹部エコーの場合は検査3時間前から\n・水分補給はOKです",
            ],
        ];

        foreach($examTypes as $examType) {
            ExamType::create($examType);
        }
    }
}
