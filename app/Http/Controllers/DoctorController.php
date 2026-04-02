<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // 一覧
    public function index()
    {
        $doctors = Doctor::latest()->paginate(10);
        return view('doctors.index', compact('doctors'));
    }


    // 作成画面
    public function create()
    {
        return view('doctors.create');
    }


    // 保存
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'specialty' => 'nullable|string|max:255',
            'phone'     => 'nullable|string|max:20',
            'email'     => 'nullable|email|max:255',
        ]);

        Doctor::create($request->only([
            'name',
            'specialty',
            'phone',
            'email',
        ]));

        return redirect()->route('doctors.index')
            ->with('success', '医師を登録しました');
    }


    // 詳細
    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }


    // 編集画面
    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }


    // 更新
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'specialty' => 'nullable|string|max:255',
            'phone'     => 'nullable|string|max:20',
            'email'     => 'nullable|email|max:255',
        ]);

        $doctor->update($request->only([
            'name',
            'specialty',
            'phone',
            'email',
        ]));

        return redirect()->route('doctors.index')
            ->with('success', '医師情報を更新しました');
    }


    // 削除
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return redirect()->route('doctors.index')
            ->with('success', '医師を削除しました');
    }
}
