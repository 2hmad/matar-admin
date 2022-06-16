<?php

namespace App\Http\Controllers;

use App\Models\ChangePassword;
use App\Models\Comments;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        if ($request->file('pic')) {
            $validate = $request->validate([
                'pic' => 'required|mimes:jpeg,png,jpg'
            ]);
            if ($validate) {
                $dataDecode = json_decode($request->data, true);
                $filename = $request->header('Authorization') . '.' . $request->pic->getClientOriginalExtension();
                $file_path = $request->file('pic')->storeAs('/users/', $filename, 'public');
                if (!$dataDecode['password']) {
                    return Users::where('token', $request->header('Authorization'))->update([
                        'name' => $dataDecode['name'],
                        'email' => $dataDecode['email'],
                        'country' => $dataDecode['country'],
                        'phone' => $dataDecode['phone'],
                        'pic' => $filename
                    ]);
                } else {
                    return Users::where('token', $request->header('Authorization'))->update([
                        'name' => $dataDecode['name'],
                        'email' => $dataDecode['email'],
                        'country' => $dataDecode['country'],
                        'phone' => $dataDecode['phone'],
                        'password' => Hash::make($dataDecode['password']),
                        'pic' => $filename
                    ]);
                }
            }
        } else {
            if (!$request->password) {
                Users::where('token', $request->header('Authorization'))->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'country' => $request->country,
                    'phone' => $request->phone,
                ]);
            } else {
                Users::where('token', $request->header('Authorization'))->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'country' => $request->country,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                ]);
            }
        }
    }
    public function shared_posts(Request $request)
    {
        return Comments::orderBy('id', 'DESC')->with('outlook')->get();
    }
    public function send_reset_password(Request $request)
    {
        $checkUser = Users::where('email', $request->email)->first();
        if ($checkUser !== null) {
            $check = ChangePassword::where('user', $request->email)->first();
            if ($check == null) {
                ChangePassword::create([
                    'user' => $request->email,
                    'token' => md5(time()),
                    'code' => Str::random(5),
                    'expire_time' => Carbon::parse(date('Y-m-d H:i'))->addMinutes(15)->format('Y-m-d H:i'),
                ]);

                // Mail::send('mail', ['id' => $getInvoice->id, 'user_id' => $getInvoice->user_id, 'invoice_id' => $getInvoice->invoice_id, 'bill_to' => $getInvoice->bill_to, 'payment' => $getInvoice->payment, 'order_date' => $getInvoice->order_date, 'description' => $getInvoice->description, 'publisher' => $getInvoice->publisher, 'price' => $getInvoice->price], function ($message) use ($getBillTo) {
                //     $message->to($getBillTo)->subject('Yammluck Invoice');
                // });
                $getCode = ChangePassword::where('user', $request->email)->first();
                if ($getCode !== null) {
                    $u_email = $request->email;
                    return Mail::send('mail', ['email' => $request->email, 'code' => $getCode->code, 'name' => $checkUser->name], function ($message) use ($u_email) {
                        $message->to($u_email)->subject('اعادة تعيين كلمة المرور');
                    });
                }
            } else {
                ChangePassword::where('user', $request->email)->update([
                    'user' => $request->email,
                    'token' => md5(time()),
                    'code' => Str::random(5),
                    'expire_time' => Carbon::parse(date('Y-m-d H:i'))->addMinutes(15)->format('Y-m-d H:i'),
                ]);
                $getCode = ChangePassword::where('user', $request->email)->first();
                if ($getCode !== null) {
                    $u_email = $request->email;
                    return Mail::send('mail', ['email' => $request->email, 'code' => $getCode->code, 'name' => $checkUser->name], function ($message) use ($u_email) {
                        $message->to($u_email)->subject('اعادة تعيين كلمة المرور');
                    });
                }
            }
        } else {
            return response()->json(['alert' => 'المستخدم غير موجود'], 404);
        }
    }
    public function check_reset_password_code(Request $request)
    {
        if ($request->code) {
            $check = ChangePassword::where('code', $request->code)->where('user', $request->email)->first();
            if ($check !== null) {
                return response()->json([], 200);
            } else {
                return response()->json(['alert' => 'الكود غير صحيح'], 404);
            }
        } else {
            return response()->json(['alert' => 'الكود غير صحيح'], 404);
        }
    }
    public function reset_password(Request $request)
    {
        if ($request->code) {
            $check = ChangePassword::where('code', $request->code)->where('user', $request->email)->first();
            if ($check !== null) {
                Users::where('email', $request->email)->update([
                    'password' => Hash::make($request->password)
                ]);
                return ChangePassword::where('code', $request->code)->where('user', $request->email)->delete();
            } else {
                return response()->json(['alert' => 'الكود غير صحيح'], 404);
            }
        } else if ($request->token) {
            $check = ChangePassword::where('token', $request->token)->where('user', $request->email)->first();
            if ($check !== null) {
                Users::where('email', $request->email)->update([
                    'password' => Hash::make($request->password)
                ]);
                return ChangePassword::where('token', $request->code)->where('user', $request->email)->delete();
            } else {
                return response()->json(['alert' => 'الكود غير صحيح'], 404);
            }
        } else {
            return response()->json(['alert' => 'الكود غير صحيح'], 404);
        }
    }
}
