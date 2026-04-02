<?php

namespace App\Http\Controllers;

use App\Models\ExamType;
use Illuminate\Http\Request;

class ExamTypeController extends Controller
{
    // 一覧
    public function index()
    {
        $examTypes = ExamType::latest()->paginate(10);
        return view('exam_types.index', compact('examTypes'));
    }


    // 作成画面
    public function create()
    {
        return view('exam_types.create');
    }


    // 保存
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'nullable|string',
            'preparation_notes' => 'nullable|string',
        ]);

        ExamType::create($request->only([
            'name',
            'description',
            'preparation_notes',
        ]));

        return redirect()->route('exam-types.index')
            ->with('success', '検査種別を登録しました');
    }


    // 詳細画面
    public function show(ExamType $examType)
    {
        return view('exam_types.show', compact('examType'));
    }


    // 編集画面
    public function edit(ExamType $examType)
    {
        return view('exam_types.edit', compact('examType'));
    }


    // 更新
    public function update(Request $request, ExamType $examType)
    {
        $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'nullable|string',
            'preparation_notes' => 'nullable|string',
        ]);

        $examType->update($request->only([
            'name',
            'description',
            'preparation_notes',
        ]));

        return redirect()->route('exam-types.index')
            ->with('success', '検査種別を更新しました');
    }


    // 削除
    public function destroy(ExamType $examType)
    {
        $examType->delete();
        return redirect()->route('exam-types.index')
            ->with('success', '検査種別を削除しました');
    }
}
