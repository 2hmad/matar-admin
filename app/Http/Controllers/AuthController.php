<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $checkUser = Users::where('email', $request->email)->first();
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
    public function register(Request $request)
    {
        $checkUser = Users::where('email', $request->email)->first();
        if ($checkUser == null) {
            Users::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'country' => $request->country,
                'token' => md5(time()),
                'date' => date('Y-m-d'),
                'ban' => 0
            ]);
        } else {
            return response()->json(['alert' => 'البريد الالكتروني مسجل من قبل'], 404);
        }
    }
    public function social(Request $request, $service)
    {
        if ($service == 'google') {
            $checkUser = Users::where('email', $request->email)->first();
            if ($checkUser !== null) {
                if ($checkUser->google_token == null) {
                    $updateService = Users::where('email', $request->email)->update([
                        'google_token' => $request->google_token
                    ]);
                    return Users::where('google_token', $request->google_token)->first();
                } else {
                    return $checkUser;
                }
            } else {
                Users::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'google_token' => $request->google_token,
                    'password' => Hash::make($request->google_token),
                    'token' => md5(time()),
                    'date' => date('Y-m-d'),
                    'ban' => 0
                ]);
                return Users::where('google_token', $request->google_token)->first();
            }
        } elseif ($service == 'facebook') {
            $checkUser = Users::where('email', $request->email)->first();
            if ($checkUser !== null) {
                if ($checkUser->facebook_token == null) {
                    $updateService = Users::where('email', $request->email)->update([
                        'facebook_token' => $request->facebook_token
                    ]);
                    return Users::where('facebook_token', $request->facebook_token)->first();
                } else {
                    return $checkUser;
                }
            } else {
                Users::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'facebook_token' => $request->facebook_token,
                    'password' => Hash::make($request->facebook_token),
                    'token' => md5(time()),
                    'date' => date('Y-m-d'),
                    'ban' => 0
                ]);
                return Users::where('facebook_token', $request->facebook_token)->first();
            }
        }
    }
    public function getAll(Request $request)
    {
        return Users::orderBy('id', 'DESC')->get();
    }
    public function deleteUser(Request $request)
    {
        return Users::where('id', $request->id)->delete();
    }
    public function banUser(Request $request)
    {
        return Users::where('id', $request->id)->update([
            'ban' => 1
        ]);
    }
    public function unBanUser(Request $request)
    {
        return Users::where('id', $request->id)->update([
            'ban' => 0
        ]);
    }
}
