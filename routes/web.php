<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $todayReservations = \App\Models\Reservation::with(['patient', 'menu'])
            ->whereDate('reserved_at', today())
            ->orderBy('reserved_at')
            ->get();

        $counts = [
            'reservations' => \App\Models\Reservation::count(),
            'patients'     => \App\Models\Patient::count(),
            'doctors'      => \App\Models\Doctor::count(),
            'staffs'       => \App\Models\Staff::count(),
        ];

        return view('dashboard', compact('todayReservations', 'counts'));
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // 検査種別
    Route::resource('exam-types', ExamTypeController::class);

    // 診療メニュー
    Route::resource('menus', MenuController::class);

    // 患者
    Route::resource('patients', PatientController::class);

    // 医師
    Route::resource('doctors', DoctorController::class);

    // スタッフ
    Route::resource('staffs', StaffController::class);

    // 予約管理
    Route::resource('reservations', ReservationController::class);
});


require __DIR__.'/auth.php';
