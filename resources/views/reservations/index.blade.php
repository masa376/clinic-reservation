<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            予約管理
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- フラッシュメッセージ --}}
            @if (session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- タブ切り替え --}}
            <div class="mb-4 flex gap-2">
                <button id="btn-list"
                        onclick="showView('list')"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    一覧表示
                </button>
                <button id="btn-calendar"
                        onclick="showView('calendar')"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                    カレンダー表示
                </button>
                <a href="{{ route('reservations.create') }}"
                    class="ml-auto px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                    + 新規予約
                </a>
            </div>

            {{-- 一覧ビュー --}}
            <div id="view-list">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">予約日時</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">患者名</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">メニュー</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">担当医師</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ステータス</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">操作</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($reservations as $reservation)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gary-900">{{ $reservation->id }}</td>
                                        <td class="px-6 py-4 text-sm text-gary-900">
                                        {{ $reservation->reserved_at->format('Y/m/d H:i') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gary-500">{{ $reservation->patient->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gary-900">{{ $reservation->menu->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gary-900">{{ $reservation->doctor->name }}</td>
                                        <td class="px-6 py-4 text-sm">
                                            @php
                                                $statusMap = [
                                                'pending' => ['label' => '受付中', 'class' => 'bg-yellow-100 text-yellow-800'],
                                                'confirmed' => ['label' => '確定', 'class' => 'bg-blue-100 text-blue-800'],
                                                'cancelled' => ['label' => 'キャンセル', 'class' => 'bg-red-100 text-red-800'],
                                                'done' => ['label' => '完了', 'class' => 'bg-green-100 text-green-800'],
                                                ];
                                                $status = $statusMap[$reservation->status];
                                            @endphp
                                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                            {{ $status['class'] }}">
                                                {{ $status['label'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm space-x-2">
                                            <a href="{{ route('reservations.show', $reservation) }}"
                                            class="text-blue-600 hover:underline">詳細</a>
                                            <a href="{{ route('reservations.edit', $reservation) }}"
                                            class="text-yellow-600 hover:underline">編集</a>
                                            <form action="{{ route('reservations.destroy', $reservation) }}"
                                                    method="POST" class="inline" onsubmit="return confirm('削除しますか？')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline">削除</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                            予約が登録されていません
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- ページネーション --}}
                    <div class="px-6 py-4">
                        {{ $reservations->links() }}
                    </div>
                </div>
            </div>

            {{-- カレンダービュー --}}
            <div id="view-calendar" class="hidden">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div id="calendar"
                        data-events="{{ $events }}"
                        style="min-height: 600px;">
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- カレンダーJS読み込み --}}
    @vite('resources/js/calendar.js')

    <script>
        function showView(view) {
            const listEl      = document.getElementById('view-list');
            const calendarEl  = document.getElementById('view-calendar');
            const btnList     = document.getElementById('btn-list');
            const btnCalendar = document.getElementById('btn-calendar');

            if (view === 'list') {
                listEl.classList.remove('hidden');
                calendarEl.classList.add('hidden');
                btnList.className     = 'px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700';
                btnCalendar.className = 'px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300';
            } else {
                listEl.classList.add('hidden');
                calendarEl.classList.remove('hidden');
                btnList.className     = 'px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300';
                btnCalendar.className = 'px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700';
            }
        }
    </script>
</x-app-layout>