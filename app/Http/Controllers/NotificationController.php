<?php
namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // ✅ 1. عرض كل الإشعارات (مع إمكانية التصفية حسب الحالة)
    public function index()
    {
        return Notification::with(['user'])->get();
    }

    // ✅ 2. عرض إشعار واحد بالتفصيل
    public function show($id)
    {
        $notification = Notification::with('user')->findOrFail($id);
        return response()->json($notification);
    }

    // ✅ 3. تحديث حالة الإشعار (مثلاً: تم القراءة)
    public function update(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);

        $validated = $request->validate([
            'read_at' => 'nullable|date',
        ]);

        $notification->update($validated);

        return response()->json($notification);
    }

    // ✅ 4. حذف إشعار (اختياري)
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return response()->json(['message' => 'Notification deleted']);
    }
}
