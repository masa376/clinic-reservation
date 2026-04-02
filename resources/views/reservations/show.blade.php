<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            予約 詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- ステータスバッジ --}}
                @php
                    $statusMap = [
                        'pending'   => ['label' => '受付中', 'class' => 'bg-yellow-100 text-yellow-800'],
                        'confirmed' => ['label' => '確定', 'class' => 'bg-blue-100 text-blue-800'],
                        'cancelled' => ['label' => 'キャンセル', 'class' => 'bg-red-100 text-red-800'],
                        'done'      => ['label' => '完了', 'class' => 'bg-green-100 text-green-800'],
                    ];
                    $status = $statusMap[$reservation->status];
                @endphp
                <div class="mb-6">
                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ $status['class'] }}">
                        {{ $status['label'] }}
                    </span>
                </div>

                {{-- 詳細情報 --}}
                <div class="mb-6 space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">予約日時</p>
                        <p class="mt-1 text-gray-900">
                            {{ $reservation->reserved_at->format('Y年m月d日 H:i') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">患者名</p>
                        <p class="mt-1 text-gray-900">
                            {{ $reservation->patient->name }}({{ $reservation->patient->name_kana }})
                        </p>
                    </div>
                    @if($reservation->patient->allergy_notes)
                    <div class="p-3 bg-red-50 rounded-md">
                        <p class="text-sm font-medium text-red-700">⚠️ アレルギー・禁忌メモ</p>
                        <p class="mt-1 text-red-600 whitespace-pre-line">
                            {{ $reservation->patient->allergy_notes }}
                        </p>
                    </div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-gray-500">診療メニュー</p>
                        <p class="mt-1 text-gray-900 ">
                            {{ $reservation->menu->examType->name }} - {{ $reservation->menu->name }}
                            ({{ $reservation->menu->duration_minutes}}分)
                        </p>
                    </div>
                    @if($reservation->menu->examType->preparation_notes)
                    <div class="p-3 bg-red-50 rounded-md">
                        <p class="text-sm font-medium text-blue-700">📋 検査前注意事項</p>
                        <p class="mt-1 text-red-600 whitespace-pre-line">
                            {{ $reservation->menu->examType->preparation_notes }}
                        </p>
                    </div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-gray-500">担当医師</p>
                        <p class="mt-1 text-gray-900">
                            {{ $reservation->doctor->name }}
                            @if($reservation->doctor->specialty)
                                ({{ $reservation->doctor->specialty }})
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">担当スタッフ</p>
                        <p class="mt-1 text-gray-900">
                            {{ $reservation->staff->name }}({{ $reservation->staff->role }})
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">メモ</p>
                        <p class="mt-1 text-gray-900">
                            {{ $reservation->memo ?? '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">登録日時</p>
                        <p class="mt-1 text-gray-900">
                            {{ $reservation->created_at->format('Y年m月d日 H:i') }}
                        </p>
                    </div>
                </div>

                {{-- ボタン --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('reservations.edit', $reservation) }}"
                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        編集する
                    </a>
                    <form action="{{ route('reservations.destroy', $reservation) }}"
                            method="POST" class="inline"
                            onsubmit="return confirm('削除しました')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            削除する
                        </button>
                    </form>
                    <a href="{{ route('reservations.index') }}"
                        class="text-gray-600 hover:underline">
                        一覧に戻る
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>