<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            スタッフ一覧
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- フラッシュメッセージ --}}
            @if(session('success'))
                <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- 新規登録ボタン --}}
            <div class="mb-4 flex justify-end">
                <a href="{{ route('staffs.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    + 新規登録
                </a>
            </div>

            {{-- テーブル --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">氏名</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">職種</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">電話番号</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">メールアドレス</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">操作</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($staffs as $staff)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $staff->id }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $staff->name }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $staff->role }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $staff->phone ?? '-' }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ $staff->email ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm space-x-2">
                                        <a href="{{ route('staffs.show', $staff) }}"
                                            class="text-blue-600 hover:underline">詳細</a>
                                        <a href="{{ route('staffs.edit', $staff) }}"
                                            class="text-yellow-600 hover:underline">編集</a>
                                        <form action="{{ route('staffs.destroy', $staff) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('削除しますか？')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">削除</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                        スタッフが登録されていません
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- ページネーション --}}
                <div class="px-6 py-4">
                    {{ $staffs->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>