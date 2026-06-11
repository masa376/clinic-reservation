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

                    {{-- 患者 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            患者 <span class="text-red-500">*</span>
                        </label>
                        <select name="patient_id"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- 選択してください --</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}"
                                    {{ old('patient_id') == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->name }} ({{ $patient->name_kana }})
                                </option>
                            @endforeach
                        </select>
                        @error('patient_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 診療メニュー --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            診療メニュー <span class="text-red-500">*</span>
                        </label>
                        <select name="menu_id" id="menu_id"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- 選択してください --</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}"
                                    {{ old('menu_id') == $menu->id ? 'selected' : '' }}>
                                    {{ $menu->examType->name }} - {{ $menu->name }} ({{ $menu->duration_minutes }}分)
                                </option>
                            @endforeach
                        </select>
                        @error('menu_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 検査前注意事項（自動表示）--}}
                    <div id="preparation-notes-box" class="hidden mb-4">
                        <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-md">
                            <p class="text-sm font-medium text-yellow-800 mb-2">
                                ⚠️ 検査前注意事項
                            </p>
                            <p id="preparation-notes-text"
                                class="text-sm text-yellow-700 whitespace-pre-line">
                            </p>
                        </div>
                    </div>

                    {{-- 担当医師 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            担当医師 <span class="text-red-500">*</span>
                        </label>
                        <select name="doctor_id"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- 選択してください --</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}"
                                    {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->name }}
                                    @if($doctor->specialty) ({{ $doctor->specialty }})
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('doctor_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 担当スタッフ --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            担当スタッフ <span class="text-red-500">*</span>
                        </label>
                        <select name="staff_id"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">-- 選択してください --</option>
                            @foreach($staffs as $staff)
                                <option value="{{ $staff->id }}"
                                    {{ old('staff_id') == $staff->id ? 'selected' : '' }}>
                                    {{ $staff->name }} ({{ $staff->role }})
                                </option>
                            @endforeach
                        </select>
                        @error('staff_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 予約日時 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            予約日時 <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local" name="reserved_at"
                                value="{{ old('reserved_at') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                        @error('reserved_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- ステータス --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            ステータス <span class="text-red-500">*</span>
                        </label>
                        <select name="status"
                                class="w-full border-gray-300 rounded-md shadow-sm">
                            <option value="pending" {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}>受付中</option>
                            <option value="confirmed" {{ old('status') === 'confirmed' ? 'selected' : '' }}>確定</option>
                            <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>キャンセル</option>
                            <option value="done" {{ old('status') === 'done' ? 'selected' : '' }}>完了</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- メモ --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            メモ
                        </label>
                        <textarea name="memo" rows="3"
                                    class="w-full border-gray-300 rounded-md shadow-sm">{{ old('memo') }}</textarea>
                        @error('memo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
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

    {{-- 検査前注意事項の自動表示 --}}
    <script>
        const preparationNotes = @json($preparationNotes);

        document.getElementById('menu_id').addEventListener('change', function () {
            const menuId = this.value;
            const notes  = JSON.parse(preparationNotes)[menuId];
            const box    = document.getElementById('preparation-notes-box');
            const text   = document.getElementById('preparation-notes-text');

            if (notes) {
                text.textContent = notes;
                box.classList.remove('hidden');
            } else {
                box.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>