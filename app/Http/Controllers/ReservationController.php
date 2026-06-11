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

        // カレンダー用データ
        $events = Reservation::with(['patient', 'menu'])
            ->get()
            ->map(function ($reservation) {
                return [
                    'id'    => $reservation->id,
                    'title' => $reservation->patient->name . '|' . $reservation->menu->name,
                    'start' => $reservation->reserved_at->format('Y-m-d\TH:i:s'),
                    'end'   => $reservation->reserved_at
                        ->addMinutes($reservation->menu->duration_minutes)
                        ->format('Y-m-d/TH:i:s'),
                    'url'   => route('reservations.show', $reservation->id),
                    'color' => match($reservation->status) {
                        'confirmed' => '#3B82F6',
                        'pending'   => '#F59E0B',
                        'cancelled' => '#EF4444',
                        'done'      => '#10B981',
                        default     => '#3B82F6',
                    },
                ];
            })
            ->toJson();

        return view('reservations.index', compact('reservations', 'events'));
    }


    // 作成画面
    public function create()
    {
        $patients = Patient::latest()->get();
        $doctors  = Doctor::latest()->get();
        $staffs   = Staff::latest()->get();
        $menus     = Menu::with('examType')->latest()->get();

        // 検査前注意事項をJSON形式で渡す
        $preparationNotes = $menus->mapWithKeys(function ($menu) {
            return [$menu->id => $menu->examType->preparation_notes];
        })->toJson();

        return view('reservations.create', compact('patients', 'doctors', 'staffs', 'menus', 'preparationNotes'));
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

        // 検査前注意事項をJSON形式で渡す
        $preparationNotes = $menus->mapWithKeys(function ($menu) {
            return [$menu->id => $menu->examType->preparation_notes];
        })->toJson();

        return view('reservations.edit', compact('reservation', 'patients', 'doctors', 'staffs', 'menus', 'preparationNotes'
        ));
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
