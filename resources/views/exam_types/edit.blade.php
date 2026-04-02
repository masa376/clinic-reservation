<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            検査種別 編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('exam-types.update', $examType) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- 検査種別名 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            検査種別名 <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name"
                                Value="{{ old('name', $examType->name) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 説明 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            説明
                        </label>
                        <textarea name="description" rows="3"
                                    class="w-full border-gray-300 rounded-md shadow-sm">{{ old('description', $examType->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 検査前注意事項 --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            検査前注意事項
                        </label>
                        <textarea name="preparation_notes" rows="3"
                                class="w-full border-gray-300 rounded-md shadow-sm">{{ old('preparation_notes', $examType->preparation_notes) }}</textarea>
                        @error('preparation_notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ボタン --}}
                    <div class="flex items-center gap-4">
                        <button type="submit"
                                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            更新する
                        </button>
                        <a href="{{ route('exam-types.index') }}"class="text-gray-600 hover:underline">
                            キャンセル
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>