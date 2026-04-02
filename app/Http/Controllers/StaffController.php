<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    // 一覧
    public function index()
    {
        $staffs = Staff::latest()->paginate(10);
        return view('staffs.index', compact('staffs'));
    }


    // 作成画面
    public function create()
    {
        return view('staffs.create');
    }


    // 保存
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'required|in:放射線技師,看護師,受付,その他',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        Staff::create($request->only([
            'name',
            'role',
            'phone',
            'email',
        ]));

        return redirect()->route('staffs.index')
            ->with('success', 'スタッフを登録しました');
    }


    // 詳細
    public function show(Staff $staff)
    {
        return view('staffs.show', compact('staff'));
    }


    // 編集画面
    public function edit(Staff $staff)
    {
        return view('staffs.edit', compact('staff'));
    }


    // 更新
    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'role'  => 'required|in:放射線技師,看護師,受付,その他',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
        ]);

        $staff->update($request->only([
            'name',
            'role',
            'phone',
            'email',
        ]));

        return redirect()->route('staffs.index')
            ->with('success', 'スタッフ情報を更新しました');
    }


    // 削除
    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staffs.index')
            ->with('success', 'スタッフを削除しました');
    }
}
