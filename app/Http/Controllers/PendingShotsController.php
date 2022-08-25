<?php

namespace App\Http\Controllers;

use App\Models\PendingShots;
use App\Models\Users;
use App\Models\WeatherShots;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PendingShotsController extends Controller
{
    public function get()
    {
        return PendingShots::orderBy('id', 'DESC')->with('user')->get();
    }
    public function send(Request $request)
    {
        $validate = $request->validate([
            'media' => 'required|mimes:jpeg,png,jpg,mp4,flv,3gp,mov,avi,wmv'
        ]);
        if ($validate) {
            $filename = time() . '.' . $request->media->getClientOriginalExtension();
            $file_path = $request->file('media')->storeAs('/weather-shots/', $filename, 'public');

            PendingShots::create([
                'user_id' => $request->user_id,
                'photographer' => $request->photographer,
                'location' => $request->location,
                'send_date' => date('Y-m-d H:i:s'),
                'date' => $request->date,
                'media' => $filename,
            ]);
        }
    }
    public function delete(Request $request)
    {
        PendingShots::where('id', $request->id)->delete();
    }
    public function accept(Request $request)
    {
        $getShot = PendingShots::where('id', $request->post_id)->first();
        if ($getShot !== null) {
            $live = WeatherShots::create([
                'photographer' => $getShot->photographer,
                'location' => $getShot->location,
                'date' => $getShot->date,
                'shares' => 0,
                'media' => $getShot->media,
            ]);
            if ($live) {
                PendingShots::where('id', $request->post_id)->delete();
            }
        }
    }
    public function reject(Request $request)
    {
        $getShot = PendingShots::where('id', $request->post_id)->first();
        File::delete(public_path() . '/storage/weather-shots/' . $getShot->media);
        PendingShots::where('id', $request->post_id)->delete();
    }
    public function share(Request $request)
    {
        $getOutlook = WeatherShots::where('id', $request->shot_id)->first();
        if ($getOutlook !== null) {
            WeatherShots::where('id', $request->shot_id)->update([
                'shares' => $getOutlook->shares + 1
            ]);
        } else {
            return response()->json(["alert" => "المنشور غير موجود"], 404);
        }
    }
}
