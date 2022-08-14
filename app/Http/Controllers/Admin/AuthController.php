<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admins;
use App\Models\Users;
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
            Users::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'country' => $request->country,
                'token' => md5(time()),
                'role' => 'admin',
                'date' => date('Y-m-d'),
                'ban' => 0
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
        // get admin email and update it from users table
        $adminEmail = Admins::where('id', $request->id)->first();
        Users::where('email', $adminEmail->email)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    }
    public function getAdmin(Request $request)
    {
        return Admins::where('id', $request->id)->first();
    }
    public function block(Request $request)
    {
        Admins::where('id', $request->id)->update(['ban' => 1]);
        // get admin email and ban him from users table
        $adminEmail = Admins::where('id', $request->id)->first()->email;
        Users::where('email', $adminEmail)->update(['ban' => 1]);
    }
    public function unblock(Request $request)
    {
        Admins::where('id', $request->id)->update(['ban' => 0]);
        $adminEmail = Admins::where('id', $request->id)->first()->email;
        Users::where('email', $adminEmail)->update(['ban' => 0]);
    }
    public function delete(Request $request)
    {
        Admins::where('id', $request->id)->delete();
        // get admin email and delete it from users
        $adminEmail = Admins::where('id', $request->id)->first()->email;
        Users::where('email', $adminEmail)->delete();
    }
    public function updateProfile(Request $request)
    {
        Admins::where('token', $request->header('token'))->update([
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country,
        ]);
        // get admin email and update it from users
        $adminEmail = Admins::where('token', $request->header('token'))->first()->email;
        Users::where('email', $adminEmail)->update([
            'name' => $request->name,
            'email' => $request->email,
            'country' => $request->country,
        ]);
    }
    public function updatePassword(Request $request)
    {
        $compare = Admins::where('token', $request->header('token'))->first();
        if (Hash::check($request->current_password, $compare->password)) {
            Admins::where('token', $request->header('token'))->update([
                'password' => Hash::make($request->new_password),
            ]);
            // get admin email and update it from users
            $adminEmail = Admins::where('token', $request->header('token'))->first()->email;
            Users::where('email', $adminEmail)->update([
                'password' => Hash::make($request->new_password),
            ]);
        } else {
            return response()->json(['alert' => 'كلمة المرور الحالية غير صحيحة'], 404);
        }
    }
}
