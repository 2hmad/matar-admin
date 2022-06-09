<?php

namespace App\Http\Controllers;

use App\Models\WeatherShots;
use Illuminate\Http\Request;

class WeatherShotsController extends Controller
{
    public function get()
    {
        return WeatherShots::orderBy('id', 'DESC')->get();
    }
    public function getByID($id)
    {
        return WeatherShots::where('id', $id)->first();
    }
    public function add(Request $request)
    {
        $validate = $request->validate([
            'media' => 'required|mimes:jpeg,png,jpg,mp4,flv,3gp,mov,avi,wmv'
        ]);
        if ($validate) {
            $dataDecode = json_decode($request->data, true);
            $filename = time() . '.' . $request->media->getClientOriginalExtension();
            $file_path = $request->file('media')->storeAs('/weather-shots/', $filename, 'public');

            return WeatherShots::create([
                'photographer' => $dataDecode['photographer'],
                'location' => $dataDecode['location'],
                'date' => $dataDecode['date'],
                'schedule' => $dataDecode['schedule'],
                'hide' => $dataDecode['hide'],
                'shares' => 0,
                'media' => $filename
            ]);
        }
    }
    public function delete(Request $request)
    {
        WeatherShots::where('id', $request->id)->delete();
    }
    public function edit(Request $request)
    {
        WeatherShots::where('id', $request->id)->update([
            'photographer' => $request->photographer,
            'location' => $request->location,
            'date' => $request->date,
            'schedule' => $request->publishDate,
            'hide' => $request->hideDate,
        ]);
    }
}
