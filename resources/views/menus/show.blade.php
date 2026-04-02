<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            診療メニュー 詳細
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- 詳細情報 --}}
                <div class="mb-6 space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">検査種別</p>
                        <p class="mt-1 text-gray-900">{{ $menu->examType->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">メニュー名</p>
                        <p class="mt-1 text-gray-900">{{ $menu->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">所要時間</p>
                        <p class="mt-1 text-gray-900">{{ $menu->duration_minutes }}分</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">料金</p>
                        <p class="mt-1 text-gray-900">
                            {{ $menu->price ? number_format($menu->price) . '円' : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">登録日時</p>
                        <p class="mt-1 text-gray-900">{{ $menu->created_at->format('Y年m月d日 H:i') }}</p>
                    </div>
                </div>

                {{-- ボタン --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('menus.edit', $menu) }}"
                        class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                        編集する
                    </a>
                    <form action="{{ route('menus.destroy', $menu) }}"
                            method="POST" class="inline"
                            onsubmit="return confirm('削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            削除する
                        </button>
                    </form>
                    <a href="{{ route('menus.index') }}"
                        class="text-gray-600 hover:underline">
                        一覧に戻る
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>