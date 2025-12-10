<?php
namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // ✅ 1. عرض كل الأطباء
    public function index()
    {
        return Doctor::with('user')->get();
    }

    // ✅ 2. إنشاء طبيب جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'specialty' => 'required|string',
            'phone' => 'required|string',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string',
        ]);

        $doctor = Doctor::create($validated);

        return response()->json($doctor, 201);
    }

    // ✅ 3. عرض طبيب واحد بالتفصيل
    public function show($id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);
        return response()->json($doctor);
    }

    // ✅ 4. تعديل بيانات طبيب
    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);

        $validated = $request->validate([
            'specialty' => 'sometimes|string',
            'phone' => 'sometimes|string',
            'gender' => 'sometimes|in:male,female,other',
            'address' => 'sometimes|string',
        ]);

        $doctor->update($validated);

        return response()->json($doctor);
    }

    // ✅ 5. حذف طبيب
    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        return response()->json(['message' => 'Doctor deleted']);
    }
}
