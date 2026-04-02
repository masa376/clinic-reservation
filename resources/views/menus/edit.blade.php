<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            診療メニュー 編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('menus.update', $menu) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- 検査種別 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            検査種別 <span class="text-red-500">*</span>
                        </label>
                        <select name="exam_type_id" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- 選択してください --</option>
                            @foreach($examTypes as $examType)
                                <option value="{{ $examType->id }}"
                                    {{ old('exam_type_id', $menu->exam_type_id) == $examType->id ? 'selected' : '' }}>
                                    {{ $examType->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('exam_type_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- メニュー名 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            メニュー名 <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name"
                                value="{{ old('name', $menu->name) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 所要時間 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            所要時間（分） <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="duration_minutes"
                                value="{{ old('duration_minutes', $menu->duration_minutes) }}"
                                min="1" class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('duration_minutes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 料金 --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            料金（円）
                        </label>
                        <input type="number" name="price"
                                value="{{ old('price', $menu->price) }}"
                                min="0" class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ボタン --}}
                    <div class="flex items-center gap-4">
                        <button type="submit"
                                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            更新する
                        </button>
                        <a href="{{ route('menus.index') }}"
                            class="text-gray-600 hover:underline">
                            キャンセル
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>