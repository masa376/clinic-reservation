<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            医師 新規登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('doctors.store') }}" method="POST">
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

                    {{-- 専門家 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            専門家
                        </label>
                        <input type="text" name="specialty" value="{{ old('specialty') }}"
                                placeholder="例：外科、内科、放射線科"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('specialty')
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
                    <div class="mb-4">
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
                        <a href="{{ route('doctors.index') }}"
                            class="text-gray-600 hover:underline">
                            キャンセル
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>