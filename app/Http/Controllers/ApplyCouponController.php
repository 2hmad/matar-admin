<?php

namespace App\Http\Controllers;

use App\Models\Coupons;
use App\Models\MarketerDetails;
use App\Models\Marketers;
use App\Models\Subscriptions;
use App\Models\UsedCoupons;
use App\Models\Users;
use Illuminate\Http\Request;

class ApplyCouponController extends Controller
{
    public function apply(Request $request)
    {
        $checkCoupon = Coupons::where('coupon', $request->coupon)->first();
        if ($checkCoupon !== null) {
            if ($checkCoupon->expire_date > date('Y-m-d')) {
                $user = Users::where('token', $request->header('Authorization'))->first();
                $checkUsed = UsedCoupons::where([
                    ['c_id', '=', $checkCoupon->id], ['u_id', '=', $user->id], ['device_id', '=', $request->device_id]
                ])->first();
                if ($checkUsed == null) {
                    UsedCoupons::create([
                        'c_id' => $checkCoupon->id,
                        'u_id' => $user->id,
                        'u_name' => $user->name,
                        'device_id' => $request->device_id,
                        'date' => date('Y-m-d')
                    ]);
                    Users::where('token', $request->header('Authorization'))->update([
                        'coupon' => $request->coupon
                    ]);
                    return $checkCoupon;
                } else {
                    return response()->json(['alert' => 'تم استخدام الكوبون من قبل'], 404);
                }
            } else {
                return response()->json(['alert' => 'كوبون غير صالح'], 404);
            }
        } else {
            $checkMarketer = Marketers::where('coupon', $request->coupon)->first();
            if ($checkMarketer !== null) {
                if ($checkMarketer->coupon_expire == null || $checkMarketer->coupon_expire >= date('Y-m-d')) {
                    $user = Users::where('token', $request->header('Authorization'))->first();
                    $checkUsed = UsedCoupons::where([
                        ['c_id', '=', $checkMarketer->id], ['u_id', '=', $user->id], ['device_id', '=', $request->device_id]
                    ])->first();
                    if ($checkUsed == null) {
                        UsedCoupons::create([
                            'c_id' => $checkMarketer->id,
                            'u_id' => $user->id,
                            'u_name' => $user->name,
                            'device_id' => $request->device_id,
                            'date' => date('Y-m-d')
                        ]);
                        Users::where('token', $request->header('Authorization'))->update([
                            'coupon' => $request->coupon
                        ]);
                        $details = MarketerDetails::where('marketer_id', $checkMarketer->id)->first();
                        if ($details !== null) {
                            MarketerDetails::create([
                                'marketer_id' => $checkMarketer->id,
                                'user_id' => $user->id,
                                'name' => $user->name,
                                'email' => $user->email,
                                'country' => $user->country,
                                'type' => 'register',
                                'amount' => $checkMarketer->reg_commission,
                                'date' => date('Y-m-d')
                            ]);
                        } else {
                            MarketerDetails::create([
                                'marketer_id' => $checkMarketer->id,
                                'user_id' => $user->id,
                                'name' => $user->name,
                                'email' => $user->email,
                                'country' => $user->country,
                                'type' => 'register',
                                'amount' => $checkMarketer->reg_commission,
                                'date' => date('Y-m-d')
                            ]);
                        }
                    } else {
                        return response()->json(['alert' => 'تم استخدام الكوبون من قبل'], 404);
                    }
                }
            } else {
                return response()->json(['alert' => 'كوبون غير صالح'], 404);
            }
        }
    }
    public function recordSubscribe(Request $request)
    {
        $token = $request->header('Authorization');
        $user = Users::where('token', $token)->first();
        if ($user->coupon !== null) {
            $marketer = Marketers::where('coupon', $user->coupon)->first();
            if ($marketer !== null) {
                MarketerDetails::create([
                    'marketer_id' => $marketer->id,
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'country' => $user->country,
                    'type' => 'subscribe',
                    'amount' => $marketer->sub_commission,
                    'date' => date('Y-m-d')
                ]);
                Subscriptions::create([
                    'user_id' => $user->id,
                    'amount' => $request->amount,
                    'start_date' => $request->start_date,
                    'expire_date' => $request->expire_date,
                    'marketer_name' => $marketer->full_name,
                    'pay_method' => $request->pay_method,
                    'active' => 1
                ]);
            } else {
                Subscriptions::create([
                    'user_id' => $user->id,
                    'amount' => $request->amount,
                    'start_date' => $request->start_date,
                    'expire_date' => $request->expire_date,
                    'pay_method' => $request->pay_method,
                    'active' => 1
                ]);
            }
        } else {
            Subscriptions::create([
                'user_id' => $user->id,
                'amount' => $request->amount,
                'start_date' => $request->start_date,
                'expire_date' => $request->expire_date,
                'pay_method' => $request->pay_method,
                'active' => 1
            ]);
        }
    }
}
