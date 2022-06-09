<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $checkUser = Admins::where('email', $request->email)->first();
        if ($checkUser !== null) {
            if (Hash::check($request->password, $checkUser->password)) {
                return $checkUser;
            } else {
                return response()->json(['alert' => 'كلمة المرور غير صحيحة'], 404);
            }
        } else {
            return response()->json(['alert' => 'الحساب غير موجود'], 404);
        }
    }
    public function admins()
    {
        return Admins::orderBy('id', 'DESC')->get();
    }
    public function addAdmin(Request $request)
    {
        $checkAdmin = Admins::where('email', $request->email)->first();
        if ($checkAdmin == null) {
            Admins::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'country' => $request->country,
                'role' => $request->role,
                'token' => md5(time()),
                'pic' => 'default.jpg',
                'ban' => 0,
                'register_date' => date('Y-m-d')
            ]);
        } else {
            return response()->json(['alert' => 'المستخدم موجود بالفعل'], 404);
        }
    }
    public function editAdmin(Request $request)
    {
        Admins::where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);
    }
    public function getAdmin(Request $request)
    {
        return Admins::where('id', $request->id)->first();
    }
    public function block(Request $request)
    {
        return Admins::where('id', $request->id)->update(['ban' => 1]);
    }
    public function unblock(Request $request)
    {
        return Admins::where('id', $request->id)->update(['ban' => 0]);
    }
    public function delete(Request $request)
    {
        return Admins::where('id', $request->id)->delete();
    }
}
