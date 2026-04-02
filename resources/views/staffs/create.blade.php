<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            スタッフ 新規登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('staffs.store') }}" method="POST">
                    @csrf

                    {{-- 氏名 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            氏名 <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 職種 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            職種 <span class="text-red-500">*</span>
                        </label>
                        <select name="role"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- 選択してください --</option>
                            <option value="放射線技師" {{ old('role') === '放射線技師' ? 'selected' : '' }}>放射線技師</option>
                            <option value="看護師" {{ old('role') === '看護師' ? 'selected' : '' }}>看護師</option>
                            <option value="受付" {{ old('role') === '受付' ? 'selected' : '' }}>受付</option>
                            <option value="その他" {{ old('role') === 'その他' ? 'selected' : '' }}>その他</option>
                        </select>
                        @error('role')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 電話番号 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            電話番号
                        </label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- メールアドレス --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            メールアドレス
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ボタン --}}
                    <div class="flex items-center gap-4">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            登録する
                        </button>
                        <a href="{{ route('staffs.index') }}"
                            class="text-gray-600 hover:underline">
                            キャンセル
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>