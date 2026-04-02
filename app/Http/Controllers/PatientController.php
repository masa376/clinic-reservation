<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // 一覧
    public function index()
    {
        $patients = Patient::latest()->paginate(10);
        return view('patients.index', compact('patients'));
    }


    // 作成画面
    public function create()
    {
        return view('patients.create');
    }


    // 保存
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'name_kana'     => 'required|string|max:255',
            'birth_date'    => 'required|date',
            'gender'        => 'required|in:male,female,other',
            'phone'         => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:255',
            'allergy_notes' => 'nullable|string',
        ]);

        Patient::create($request->only([
            'name',
            'name_kana',
            'birth_date',
            'gender',
            'phone',
            'email',
            'allergy_notes',
        ]));

        return redirect()->route('patients.index')
            ->with('success', '患者を登録しました');
    }


    // 詳細
    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }


    // 編集画面
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }


    // 更新
    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'name_kana'     => 'required|string|max:255',
            'birth_date'    => 'required|date',
            'gender'        => 'required|in:male,female,other',
            'phone'         => 'nullable|string|max:20',
            'email'         => 'nullable|email|max:255',
            'allergy_notes' => 'nullable|string',
        ]);

        $patient->update($request->only([
            'name',
            'name_kana',
            'birth_date',
            'gender',
            'phone',
            'email',
            'allergy_notes',
        ]));

        return redirect()->route('patients.index')
            ->with('success', '患者情報を更新しました');
    }


    // 削除
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')
            ->with('success', '患者を削除しました');
    }
}
