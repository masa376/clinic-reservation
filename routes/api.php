<?php

use App\Models\Menu;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Staff;
use Illuminate\Support\Facades\Route;

// 予約フォーム用データ
Route::get('/reservation-form-data', function () {
    return response()->json([
        'patients' => Patient::orderBy('name_kana')->get(),
        'menus'    => Menu::with('examType')->orderBy('id')->get()->map(function ($menu) {
            return [
                'id'               => $menu->id,
                'name'             => $menu->name,
                'duration_minutes' => $menu->duration_minutes,
                'price'            => $menu->price,
                'exam_type'        => [
                    'name'              => $menu->examType->name,
                    'preparation_notes' => $menu->examType->preparation_notes,
                ],
            ];
        }),
        'doctors' => Doctor::orderBy('name')->get(),
        'staffs'  => Staff::orderBy('name')->get(),
    ]);
});
