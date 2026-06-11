<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            予約 編集
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('reservations.update', $reservation) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- 患者 --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            患者 <span class="text-red-500">*</span>
                        </label>
                        <select name="patient_id"
                                class="w-full border-gary-300 rounded-md shadow-sm">
                            <option value="">-- 選択してください --</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}"
                                    {{ old('patient_id', $reservation->patient_id) == $patient->id ? 'selected' : '' }}>
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
                                class="w-full border-gary-300 rounded-md shadow-sm">
                            <option value="">-- 選択してください --</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}"
                                    {{ old('menu_id', $reservation->menu_id) == $menu->id ? 'selected' : '' }}>
                                    {{ $menu->examType->name }} - {{ $menu->name }} ({{ $menu->duration_minutes }}分)
                                </option>
                            @endforeach
                        </select>
                        @error('menu_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 検査前注意事項 （自動表示）--}}
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
                                class="w-full border-gary-300 rounded-md shadow-sm">
                            <option value="">-- 選択してください --</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}"
                                    {{ old('doctor_id', $reservation->doctor_id) == $doctor->id ? 'selected' : '' }}>
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
                                class="w-full border-gary-300 rounded-md shadow-sm">
                            <option value="">-- 選択してください --</option>
                            @foreach($staffs as $staff)
                                <option value="{{ $staff->id }}"
                                    {{ old('staff_id', $reservation->staff_id) == $staff->id ? 'selected' : '' }}>
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
                                value="{{ old('reserved_at', $reservation->reserved_at->format('Y-m-d\TH:i')) }}"
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
                            <option value="pending" {{ old('status', $reservation->status) === 'pending' ? 'selected' : '' }}>受付中</option>
                            <option value="confirmed" {{ old('status', $reservation->status) === 'confirmed' ? 'selected' : '' }}>確定</option>
                            <option value="cancelled" {{ old('status', $reservation->status) === 'cancelled' ? 'selected' : '' }}>キャンセル</option>
                            <option value="done" {{ old('status', $reservation->status) === 'done' ? 'selected' : '' }}>完了</option>
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
                                    class="w-full border-gray-300 rounded-md shadow-sm">{{ old('memo', $reservation->memo) }}</textarea>
                        @error('memo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

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
                                    <option value="mSv" {{ old('dose_unit', $reservation->dose_unit) === 'mSv' ? 'selected' : '' }}>mSv（実行線量）</option>
                                    <option value="mGv" {{ old('dose_unit', $reservation->dose_unit) === 'mGv' ? 'selected' : '' }}>mGy（CTDIvol）</option>
                                    <option value="mGy・cm" {{ old('dose_unit', $reservation->dose_unit) === 'mGy・cm' ? 'selected' : '' }}>mGy・cm（DLP）</option>
                                    <option value="μSv" {{ old('dose_unit', $reservation->dose_unit) === 'μSv' ? 'selected' : '' }}>μSv</option>
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
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-yellow-700">
                            更新する
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