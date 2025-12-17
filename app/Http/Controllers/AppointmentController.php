<?php


 namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // ✅ عرض كل المواعيد
    public function index()
    {
        return Appointment::with(['doctor.user', 'patient.user'])->get();
    }

    // ✅ إنشاء موعد جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,doctor_id',
            'patient_id' => 'required|exists:patients,patient_id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'status' => 'required|in:scheduled,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $appointment = Appointment::create($validated);

        return response()->json($appointment, 201);
    }

    // ✅ عرض موعد واحد
    public function show($id)
    {
        $appointment = Appointment::with(['doctor.user', 'patient.user'])->findOrFail($id);
        return response()->json($appointment);
    }

    // ✅ تعديل موعد
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

          $validated = $request->validate([
            'appointment_date' => 'sometimes|date',
            'appointment_time' => 'sometimes',
            'status' => 'sometimes|in:scheduled,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($validated);

        return response()->json($appointment);
    }

    // ✅ حذف موعد
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return response()->json(['message' => 'Appointment deleted']);
    }
}

    
