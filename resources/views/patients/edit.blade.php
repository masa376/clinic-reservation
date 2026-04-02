<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            患者 編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('patients.update', $patient) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- 氏名 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            氏名 <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name"
                                value="{{ old('name', $patient->name) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 氏名カナ --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            氏名カナ <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name_kana"
                                value="{{ old('name_kana', $patient->name_kana) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('name_kana')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 生年月日 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            生年月日 <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="birth_date"
                                value="{{ old('birth_date', $patient->birth_date->format('Y-m-d')) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('birth_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 性別 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            性別 <span class="text-red-500">*</span>
                        </label>
                        <select name="gender" class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- 選択してください --</option>
                            <option value="male" {{ old('gender', $patient->gender) === 'male' ? 'selected' : '' }}>男性</option>
                            <option value="female" {{ old('gender', $patient->gender) === 'female' ? 'selected' : '' }}>女性</option>
                            <option value="other" {{ old('gender', $patient->gender) === 'other' ? 'selected' : '' }}>その他</option>
                        </select>
                        @error('gender')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 電話番号 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            電話番号
                        </label>
                        <input type="text" name="phone"
                                value="{{ old('phone', $patient->phone) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- メールアドレス --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            メールアドレス
                        </label>
                        <input type="email" name="email"
                                value="{{ old('birth_date', $patient->email) }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- アレルギー・禁忌メモ --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            アレルギー・禁忌
                        </label>
                        <textarea name="allergy_notes" rows="3"
                                    class="w-full border-gray-300 rounded-md shadow-sm">{{ old('allergy_notes', $patient->allergy_notes) }}</textarea>
                        @error('allergy_notes')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ボタン --}}
                    <div class="flex items-center gap-4">
                        <button type="submit"
                                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                            更新する
                        </button>
                        <a href="{{ route('patients.index') }}"
                            class="text-gray-600 hover:underline">
                            キャンセル
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>