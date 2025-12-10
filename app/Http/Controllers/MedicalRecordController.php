<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    // ✅ 1. عرض كل السجلات الطبية
    public function index()
    {
        return MedicalRecord::with(['doctor.user', 'patient.user'])->get();
    }

    // ✅ 2. إنشاء سجل طبي جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'patient_id' => 'required|exists:patients,patient_id',
            'diagnosis' => 'required|string',
            'treatment' => 'required|string',
            'visit_date' => 'required|date',
            'attachments' => 'nullable|string', // لاحقًا ممكن نعمله رفع ملفات
        ]);

        $record = MedicalRecord::create($validated);

        return response()->json($record, 201);
    }

    // ✅ 3. عرض سجل طبي واحد بالتفصيل
    public function show($id)
    {
        $record = MedicalRecord::with(['doctor.user', 'patient.user'])->findOrFail($id);
        return response()->json($record);
    }

    // ✅ 4. تعديل سجل طبي
    public function update(Request $request, $id)
    {
        $record = MedicalRecord::findOrFail($id);

        $validated = $request->validate([
            'diagnosis' => 'sometimes|string',
            'treatment' => 'sometimes|string',
            'visit_date' => 'sometimes|date',
            'attachments' => 'nullable|string',
        ]);

        $record->update($validated);

        return response()->json($record);
    }

    // ✅ 5. حذف سجل طبي
    public function destroy($id)
    {
        $record = MedicalRecord::findOrFail($id);
        $record->delete();

        return response()->json(['message' => 'Medical record deleted']);
    }
}
