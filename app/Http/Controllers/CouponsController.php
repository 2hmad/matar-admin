<?php

namespace App\Http\Controllers;

use App\Models\Coupons;
use App\Models\UsedCoupons;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function get()
    {
        return Coupons::orderBy('id', 'DESC')->with('usedBy')->get();
    }
    public function getByID($id)
    {
        return Coupons::where('id', $id)->first();
    }
    public function edit(Request $request)
    {
        return Coupons::where('id', $request->id)->update([
            'coupon' => $request->coupon,
            'country' => $request->country,
            'expire_date' => $request->expire_date,
        ]);
    }
    public function add(Request $request)
    {
        Coupons::create([
            'coupon' => $request->coupon,
            'country' => $request->country,
            'days' => $request->days,
            'expire_date' => $request->expire_date,
            'active' => 1,
        ]);
    }
    public function disable(Request $request)
    {
        Coupons::where('id', $request->id)->update([
            'active' => 0,
        ]);
    }
    public function enable(Request $request)
    {
        Coupons::where('id', $request->id)->update([
            'active' => 1,
        ]);
    }
    public function delete(Request $request)
    {
        Coupons::where('id', $request->id)->delete();
        UsedCoupons::where('c_id', $request->id)->delete();
    }
}
