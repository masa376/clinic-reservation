<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            患者 詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- 詳細情報 --}}
                <div class="mb-6 space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">氏名</p>
                        <p class="mt-1 text-gray-900">{{ $patient->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">氏名カナ</p>
                        <p class="mt-1 text-gray-900">{{ $patient->name_kana }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">生年月日</p>
                        <p class="mt-1 text-gray-900">
                            {{ $patient->birth_date->format('Y年m月d日') }}
                            ({{ $patient->birth_date->age}}歳)
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">性別</p>
                        <p class="mt-1 text-gray-900">
                            @if($patient->gender === 'male') 男性
                            @elseif($patient->gender === 'female') 女性
                            @else その他
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">電話番号</p>
                        <p class="mt-1 text-gray-900">
                            {{ $patient->phone ?? '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">メールアドレス</p>
                        <p class="mt-1 text-gray-900">
                            {{ $patient->email ?? '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">アレルギー・禁忌メモ</p>
                        <p class="mt-1 text-gray-900 whitespace-pre-line">
                            {{ $patient->allergy_notes ?? '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">登録日時</p>
                        <p class="mt-1 text-gray-900">{{ $patient->created_at->format('Y年m月d日 H:i') }}</p>
                    </div>
                </div>

                {{-- ボタン --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('patients.edit', $patient) }}"
                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        編集する
                    </a>
                    <form action="{{ route('patients.destroy', $patient) }}"
                            method="POST" class="inline"
                            onsubmit="return confirm('削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            削除する
                        </button>
                    </form>
                    <a href="{{ route('patients.index') }}"
                        class="text-gray-600 hover:underline">
                        一覧に戻る
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>