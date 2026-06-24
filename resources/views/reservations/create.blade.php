<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            予約 新規登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('reservations.store') }}" method="POST">
                    @csrf

                    {{-- Reactコンポーネントのマウント先 --}}
                    <div id="reservation-form-root"></div>

                    {{-- 放射線線量メモ --}}
                    <div class="mb-6 border border-blue-200 rounded-md p-4 bg-blue-50">
                        <p class="text-sm font-medium text-blue-800 mb-3">
                            📊 放射線線量記録（検査後に入力）
                        </p>
                        <div class="grid grid-cols-2 gap-4 mb-3">
                            {{-- 線量値 --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    線量値
                                </label>
                                <input type="number" name="dose_value"
                                        value="{{ old('dose_value') }}"
                                        step="0.01" min="0"
                                        placeholder="例：12.5"
                                        class="w-full border-gray-300 rounded-md shadow-sm">
                                @error('dose_value')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            {{-- 単位 --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                    単位
                                </label>
                                <select name="dose_unit"
                                        class="w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">-- 選択 --</option>
                                    <option value="mSv" {{ old('dose_unit') === 'mSv' ? 'selected' : '' }}>mSv（実行線量）</option>
                                    <option value="mGv" {{ old('dose_unit') === 'mGv' ? 'selected' : '' }}>mGy（CTDIvol）</option>
                                    <option value="mGy・cm" {{ old('dose_unit') === 'mGy・cm' ? 'selected' : '' }}>mGy・cm（DLP）</option>
                                    <option value="μSv" {{ old('dose_unit') === 'μSv' ? 'selected' : '' }}>μSv</option>
                                </select>
                                @error('dose_unit')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        {{-- 線量メモ --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                線量メモ
                            </label>
                            <textarea name="dose_memo" rows="2"
                                        placeholder="例：CTDIvol: 12.5 mGy / DLP: 350 mGy・cm"
                                        class="w-full border-gray-300 rounded-md shadow-sm">{{ old('dose_memo')}}</textarea>
                            @error('dose_memo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- ボタン --}}
                    <div class="flex items-center gap-4">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            登録する
                        </button>
                        <a href="{{ route('reservations.index') }}"
                            class="text-gray-600 hover:underline">
                            キャンセル
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @vite('resources/tsx/reservation-form.tsx')

</x-app-layout>