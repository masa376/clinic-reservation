<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ダッシュボード
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- 集計カード --}}
            <div class="grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <p class="text-sm font-medium text-gray-500">総予約数</p>
                    <p class="mt-2 text-3xl font-bold text-blue-600">{{ $counts['reservations']}}</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <p class="text-sm font-medium text-gray-500">患者数</p>
                    <p class="mt-2 text-3xl font-bold text-green-600">{{ $counts['patients']}}</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <p class="text-sm font-medium text-gray-500">医師数</p>
                    <p class="mt-2 text-3xl font-bold text-blue-600">{{ $counts['doctors']}}</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                    <p class="text-sm font-medium text-gray-500">スタッフ数</p>
                    <p class="mt-2 text-3xl font-bold text-orange-600">{{ $counts['staffs']}}</p>
                </div>
            </div>

            {{-- 本日の予約一覧 --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">
                        本日の予約
                        <span class="ml-2 text-sm text-gray-500">
                            {{ now()->format('Y年m月d日') }}
                        </span>
                    </h3>
                    <a href="{{ route('reservations.create') }}"
                        class="px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">
                        + 新規予約
                    </a>
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">時間</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">患者名</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">メニュー</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">アレルギー</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ステータス</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">操作</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($todayReservations as $reservation)
                            @php
                                $statusMap = [
                                'pending' => ['label' => '受付中', 'class' => 'bg-yellow-100 text-yellow-800'],
                                'confirmed' => ['label' => '確定中', 'class' => 'bg-blue-100 text-blue-800'],
                                'cancelled' => ['label' => 'キャンセル', 'class' => 'bg-red-100 text-red-800'],
                                'done' => ['label' => '完了', 'class' => 'bg-green-100 text-green-800'],
                                ];
                                $status = $statusMap[$reservation->status];
                            @endphp
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $reservation->reserved_at->format('H:i') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $reservation->patient->name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    {{ $reservation->menu->name }}
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($reservation->patient->allergy_notes)
                                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-xs font-medium">
                                            ⚠️ あり
                                        </span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $status['class'] }}">
                                        {{ $status['label']}}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <a href="{{ route('reservations.show', $reservation) }}"
                                        class="text-blue-600 hover:underline">詳細</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    本日の予約はありません
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
