<?php

namespace App\Http\Controllers;

use App\Models\MarketerDetails;
use App\Models\Marketers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MarketersController extends Controller
{
    public function get()
    {
        return Marketers::orderBy('id', 'DESC')->get();
    }
    public function getByID(Request $request)
    {
        return Marketers::where('id', $request->id)->with('details')->first();
    }
    public function add(Request $request)
    {
        Marketers::create([
            'coupon' => Str::random(7),
            'full_name' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'country' => $request->country,
            'password' => Hash::make($request->password),
            'coupon_expire' => $request->coupon_expire,
            'reg_commission' => $request->reg_commission,
            'sub_commission' => $request->sub_commission,
            'facebook_acc' => $request->facebook_acc,
            'twitter_acc' => $request->twitter_acc,
            'instagram_acc' => $request->instagram_acc,
            'tiktok_acc' => $request->tiktok_acc,
            'token' => md5(time()),
            'ban' => 0,
            'active' => 1
        ]);
    }
    public function edit(Request $request)
    {
        Marketers::where('id', $request->id)->update([
            'full_name' => $request->name,
            'coupon_expire' => $request->coupon_expire,
            'reg_commission' => $request->reg_commission,
            'sub_commission' => $request->sub_commission,
            'phone' => $request->phone,
            'facebook_acc' => $request->facebook_acc,
            'twitter_acc' => $request->twitter_acc,
            'instagram_acc' => $request->instagram_acc,
            'tiktok_acc' => $request->tiktok_acc,
        ]);
    }
    public function delete(Request $request)
    {
        Marketers::where('id', $request->id)->delete();
    }
    public function disable(Request $request)
    {
        Marketers::where('id', $request->id)->update([
            'active' => 0
        ]);
    }
    public function enable(Request $request)
    {
        Marketers::where('id', $request->id)->update([
            'active' => 1
        ]);
    }
    public function block(Request $request)
    {
        Marketers::where('id', $request->id)->update([
            'ban' => 1
        ]);
    }
    public function unblock(Request $request)
    {
        Marketers::where('id', $request->id)->update([
            'ban' => 0
        ]);
    }
    public function withdraw(Request $request)
    {
        MarketerDetails::where('marketer_id', $request->id)->delete();
    }
}
