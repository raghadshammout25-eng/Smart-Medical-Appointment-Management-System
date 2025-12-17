<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // ✅ 1. عرض كل المستخدمين
    public function index()
    {
        return response()->json(User::all());
    }

    // ✅ 2. إنشاء مستخدم جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,doctor,patient',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    // ✅ 3. عرض مستخدم واحد بالتفصيل
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // ✅ 4. تعديل بيانات مستخدم
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'sometimes|string|max:255',
            'email'    => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:6',
            'role'     => 'sometimes|in:admin,doctor,patient',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json($user);
    }

    // ✅ 5. حذف مستخدم
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }


public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    // جلب المستخدم
    $user = User::where('email', $credentials['email'])->first();

/// التحقق من وجود المستخدم
    if (! $user) {
        return response()->json(['message' => 'المستخدم غير موجود'], 404);
    }

    // التحقق من كلمة المرور
    if (! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'كلمة المرور غير صحيحة'], 401);
    }
 //تسجيل دخول ناجح
    return response()->json([
        'message' => 'تم تسجيل الدخول بنجاح',
        'user' => $user,
    ]);
}



}
