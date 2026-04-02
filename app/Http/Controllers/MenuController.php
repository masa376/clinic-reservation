<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\ExamType;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    // 一覧
    public function index()
    {
        $menus = Menu::with('examType')->latest()->paginate(10);
        return view('menus.index', compact('menus'));
    }


    // 作成画面
    public function create()
    {
        $examTypes = ExamType::latest()->get();
        return view('menus.create', compact('examTypes'));
    }


    // 保存
    public function store(Request $request)
    {
        $request->validate([
            'exam_type_id'      => 'required|exists:exam_types,id',
            'name'              => 'required|string|max:255',
            'duration_minutes'  => 'required|integer|min:1',
            'price'             => 'nullable|integer|min:0',
        ]);

        Menu::create($request->only([
            'exam_type_id',
            'name',
            'duration_minutes',
            'price',
        ]));

        return redirect()->route('menus.index')
            ->with('success', '診療メニューを登録しました');
    }


    // 詳細
    public function show(Menu $menu)
    {
        return view('menus.show', compact('menu'));
    }


    // 編集画面
    public function edit(Menu $menu)
    {
        $examTypes = ExamType::latest()->get();
        return view('menus.edit', compact('menu', 'examTypes'));
    }


    // 更新
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'exam_type_id' => 'required|exists:exam_types,id',
            'name' => 'required|string|max:255',
            'duration_minutes' => 'required|integer|min:1',
            'price' => 'nullable|integer|min:0',
        ]);

        $menu->update($request->only([
            'exam_type_id',
            'name',
            'duration_minutes',
            'price',
        ]));

        return redirect()->route('menus.index')
            ->with('success', '診療メニューを更新しました');
    }



    // 削除
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menus.index')
            ->with('success', '診療メニューを削除しました');
    }
}
