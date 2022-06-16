<?php

namespace App\Http\Controllers;

use App\Models\Coupons;
use App\Models\MarketerDetails;
use App\Models\Marketers;
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
                if ($checkMarketer->expire_date > date('Y-m-d')) {
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
                                'amount' => $details->amount + $checkMarketer->reg_commission,
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
                                'amount' => 0 + $checkMarketer->reg_commission,
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
}
