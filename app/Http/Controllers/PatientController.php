<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // ✅ 1. عرض كل المرضى
    public function index()
    {
        return Patient::with('user')->get();
    }

    // ✅ 2. إنشاء مريض جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'birth_date' => 'required|date',
            'phone' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string',
        ]);

        $patient = Patient::create($validated);

        return response()->json($patient, 201);
    }

    // ✅ 3. عرض مريض واحد بالتفصيل
    public function show($id)
    {
        $patient = Patient::with('user')->findOrFail($id);
        return response()->json($patient);
    }

    // ✅ 4. تعديل بيانات مريض
    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $validated = $request->validate([
            'birth_date' => 'sometimes|date',
            'phone' => 'sometimes|string',
            'gender' => 'sometimes|in:male,female,other',
            'address' => 'sometimes|string',
        ]);

        $patient->update($validated);

        return response()->json($patient);
    }

    // ✅ 5. حذف مريض
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return response()->json(['message' => 'Patient deleted']);
    }
}
