<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\AdsDetails;
use App\Models\Users;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function get()
    {
        return Ads::orderBy('id', 'DESC')->with('details')->get();
    }
    public function views(Request $request)
    {
        $header = $request->header('Authorization');
        $user = Users::where('token', $header)->first();
        $checkCountry = AdsDetails::where([
            ['country', '=', $user->country], ['type', '=', 'view']
        ])->first();
        if ($checkCountry == null) {
            return AdsDetails::create([
                'ad_id' => $request->ad_id,
                'country' => $user->country,
                'count' => 1,
                'type' => 'view'
            ]);
        } else {
            return AdsDetails::where([
                ['country', '=', $user->country],
                ['type', '=', 'view']
            ])->update([
                'count' => $checkCountry->count + 1
            ]);
        }
    }
    public function clicks(Request $request)
    {
        $header = $request->header('Authorization');
        $user = Users::where('token', $header)->first();
        $checkCountry = AdsDetails::where([
            ['country', '=', $user->country], ['type', '=', 'click']
        ])->first();
        if ($checkCountry == null) {
            return AdsDetails::create([
                'ad_id' => $request->ad_id,
                'country' => $user->country,
                'count' => 1,
                'type' => 'click'
            ]);
        } else {
            return AdsDetails::where([
                ['country', '=', $user->country],
                ['type', '=', 'click']
            ])->update([
                'count' => $checkCountry->count + 1
            ]);
        }
    }
    public function add(Request $request)
    {
        $validate = $request->validate([
            'media' => 'required|mimes:jpeg,png,jpg,mp4,flv,3gp,mov,avi,wmv'
        ]);
        if ($validate) {
            $dataDecode = json_decode($request->data, true);
            $filename = time() . '.' . $request->media->getClientOriginalExtension();
            $file_path = $request->file('media')->storeAs('/ads/', $filename, 'public');

            return Ads::create([
                'title' => $dataDecode['title'],
                'redirect' => $dataDecode['redirect'],
                'hide' => $dataDecode['hide'],
                'location' => $dataDecode['location'],
                'country' => $dataDecode['country'],
                'media' => $filename
            ]);
        }
    }
    public function delete(Request $request)
    {
        Ads::where('id', $request->id)->delete();
        AdsDetails::where('ad_id', $request->id)->delete();
    }
}
