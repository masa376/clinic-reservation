import React, { useState, useEffect } from 'react';
import { createRoot } from 'react-dom/client';

interface Patient {
    id: number;
    name: string;
    name_kana: string;
    allergy_notes: string | null;
}

interface ExamType {
    name: string;
    preparation_notes: string | null;
}

interface Menu {
    id: number;
    name: string;
    duration_minutes: number;
    price: number | null;
    exam_type: ExamType;
}

interface Doctor {
    id: number;
    name: string;
    specialty: string | null;
}

interface Staff {
    id: number;
    name: string;
    role: string;
}

interface FormData {
    patients: Patient[];
    menus: Menu[];
    doctors: Doctor[];
    staffs: Staff[];
}

function ReservationForm() {
    const [formData, setFormData] = useState<FormData | null>(null);
    const [selectedPatient, setSelectedPatient] = useState<Patient | null>(null);
    const [selectedMenu, setSelectedMenu] = useState<Menu | null>(null);
    const [loading, setLoading] = useState(true);

    // フォームデータをAPIから取得
    useEffect(() => {
        fetch('/api/reservation-form-data')
            .then(res => res.json())
            .then(data => {
                setFormData(data);
                setLoading(false);
            });
    }, []);

    const handlePatientChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        const patient = formData?.patients.find(p => p.id === Number(e.target.value));
        setSelectedPatient(patient || null);
    };

    const handleMenuChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
        const menu = formData?.menus.find(m => m.id === Number(e.target.value));
        setSelectedMenu(menu || null);
    };

    if (loading) {
        return (
            <div className="text-center py-8 text-gray-500">
                読み込み中...
            </div>
        );
    }

    return (
        <div>
            {/* 患者選択 */}
            <div className="mb-4">
                <label className="block text-sm font-medium text-gray-700 mb-1">
                    患者 <span className="text-red-500">*</span>
                </label>
                <select
                    name="patient_id"
                    onChange={handlePatientChange}
                    className="w-full border-gray-300 rounded-md shadow-sm border px-3 py-2"
                >
                    <option value="">-- 選択してください --</option>
                    {formData?.patients.map((patient) => (
                        <option key={patient.id} value={patient.id}>
                            {patient.name} ({patient.name_kana})
                        </option>
                    ))}
                </select>
            </div>

            {/* アレルギー情報の自動表示 */}
            {selectedPatient?.allergy_notes && (
                <div className="mb-4 p-4 bg-red-50 border border-red-200 rounded-md">
                    <p className="text-sm font-medium text-red-800 mb-1">
                        ⚠️ アレルギー・禁忌情報
                    </p>
                    <p className="text-sm text-red-700 whitespace-pre-line">
                        {selectedPatient.allergy_notes}
                    </p>
                </div>
            )}

            {/* 診療メニュー選択 */}
            <div className="mb-4">
                <label className="block text-sm font-medium text-gray-700 mb-1">
                    診療メニュー <span className="text-red-500">*</span>
                </label>
                <select
                    name="menu_id"
                    onChange={handleMenuChange}
                    className="w-full border-gray-300 rounded-md shadow-sm border px-3 py-2"
                >
                    <option value="">-- 選択してください --</option>
                    {formData?.menus.map((menu) => (
                        <option key={menu.id} value={menu.id}>
                            {menu.exam_type.name} - {menu.name} (
                            {menu.duration_minutes}分)
                        </option>
                    ))}
                </select>
            </div>

            {/* メニュー情報の自動表示 */}
            {selectedMenu && (
                <div className="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-md">
                    <div className="flex gap-6 mb-2">
                        <p className="text-sm text-blue-800">
                            🕒 所要時間：
                            <strong>{selectedMenu.duration_minutes}分</strong>
                        </p>
                        {selectedMenu.price && (
                            <p className="text-sm text-blue-800">
                                💴 料金：
                                <strong>
                                    {selectedMenu.price.toLocaleString()}円
                                </strong>
                            </p>
                        )}
                    </div>
                    {selectedMenu.exam_type.preparation_notes && (
                        <div className="mt-2 pt-2 border-t border-blue-200">
                            <p className="text-sm font-medium text-blue-800 mb-1">
                                📋 検査前注意事項
                            </p>
                            <p className="text-sm text-blue-700 whitespace-pre-line">
                                {selectedMenu.exam_type.preparation_notes}
                            </p>
                        </div>
                    )}
                </div>
            )}

            {/* 担当医師 */}
            <div className="mb-4">
                <label className="block text-sm font-medium text-gray-700 mb-1">
                    担当医師 <span className="text-red-500">*</span>
                </label>
                <select
                    name="doctor_id"
                    className="w-full border-gray-300 rounded-md shadow-sm border px-3 py-2"
                >
                    <option value="">-- 選択してください --</option>
                    {formData?.doctors.map(doctor => (
                        <option key={doctor.id} value={doctor.id}>
                            {doctor.name}{doctor.specialty ? `(${doctor.specialty})` : ''}
                        </option>
                    ))}
                </select>
            </div>

            {/* 担当スタッフ */}
            <div className="mb-4">
                <label className="block text-sm font-medium text-gray-700 mb-1">
                    担当スタッフ <span className="text-red-500">*</span>
                </label>
                <select
                    name="staff_id"
                    className="w-full border-gray-300 rounded-md shadow-sm border px-3 py-2"
                >
                    <option value="">-- 選択してください --</option>
                    {formData?.staffs.map(staff => (
                        <option key={staff.id} value={staff.id}>
                            {staff.name} ({staff.role})
                        </option>
                    ))}
                </select>
            </div>

            {/* 予約日時 */}
            <div className="mb-4">
                <label className="block text-sm font-medium text-gray-700 mb-1">
                    予約日時 <span className="text-red-500">*</span>
                </label>
                <input
                    type="datetime-local"
                    name="reserved_at"
                    className="w-full border-gray-300 rounded-md shadow-sm border px-3 py-2"
                />
            </div>

            {/* ステータス */}
            <div className="mb-4">
                <label className="block text-sm font-medium text-gray-700 mb-1">
                    ステータス <span className="text-red-500">*</span>
                </label>
                <select
                    name="status"
                    defaultValue="pending"
                    className="w-full border-gray-300 rounded-md shadow-sm border px-3 py-2"
                >
                    <option value="pending">受付中</option>
                    <option value="confirmed">確定</option>
                    <option value="cancelled">キャンセル</option>
                    <option value="done">完了</option>
                </select>
            </div>

            {/* メモ */}
            <div className="mb-6">
                <label className="block text-sm font-medium text-gray-700 mb-1">
                    メモ
                </label>
                <textarea
                    name="memo"
                    rows={3}
                    className="w-full border-gray-300 rounded-md shadow-sm border px-3 py-2"
                />
            </div>
        </div>
    );
}

// Reactをマウント
const container = document.getElementById('reservation-form-root');
if (container) {
    createRoot(container).render(<ReservationForm />);
}