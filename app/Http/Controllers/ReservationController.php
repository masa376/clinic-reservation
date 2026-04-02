<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Staff;
use App\Models\Menu;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // 一覧
    public function index()
    {
        $reservations = Reservation::with(['patient', 'doctor', 'staff', 'menu'])
            ->latest()
            ->paginate(10);

        return view('reservations.index', compact('reservations'));
    }


    // 作成画面
    public function create()
    {
        $patients = Patient::latest()->get();
        $doctors  = Doctor::latest()->get();
        $staffs   = Staff::latest()->get();
        $menus     = Menu::with('examType')->latest()->get();

        return view('reservations.create', compact('patients', 'doctors', 'staffs', 'menus'));
    }


    // 保存
    public function store(Request $request)
    {
        $request->validate([
            'patient_id'  => 'required|exists:patients,id',
            'doctor_id'   => 'required|exists:doctors,id',
            'staff_id'    => 'required|exists:staffs,id',
            'menu_id'     => 'required|exists:menus,id',
            'reserved_at' => 'required|date',
            'status'      => 'required|in:pending,confirmed,cancelled,done',
            'memo'        => 'nullable|string',
        ]);

        Reservation::create($request->only([
            'patient_id',
            'doctor_id',
            'staff_id',
            'menu_id',
            'reserved_at',
            'status',
            'memo',
        ]));

        return redirect()->route('reservations.index')
            ->with('success', '予約を登録しました');
    }


    // 詳細
    public function show(Reservation $reservation)
    {
        return view('reservations.show', compact('reservation'));
    }


    // 編集画面
    public function edit(Reservation $reservation)
    {
        $patients = Patient::latest()->get();
        $doctors  = Doctor::latest()->get();
        $staffs   = Staff::latest()->get();
        $menus     = Menu::with('examType')->latest()->get();

        return view('reservations.edit', compact('reservation', 'patients', 'doctors', 'staffs', 'menus'));
    }


    // 更新
    public function update(Request $request, Reservation $reservation)
    {
        $request->validate([
            'patient_id'  => 'required|exists:patients,id',
            'doctor_id'   => 'required|exists:doctors,id',
            'staff_id'    => 'required|exists:staffs,id',
            'menu_id'     => 'required|exists:menus,id',
            'reserved_at' => 'required|date',
            'status'      => 'required|in:pending,confirmed,cancelled,done',
            'memo'        => 'nullable|string',
        ]);

        $reservation->update($request->only([
            'patient_id',
            'doctor_id',
            'staff_id',
            'menu_id',
            'reserved_at',
            'status',
            'memo',
        ]));

        return redirect()->route('reservations.index')
            ->with('success', '予約を更新しました');
    }

    // 削除
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('reservations.index')
            ->with('success', '予約を削除しました');
    }
}
