<?php

namespace App\Http\Controllers;

use App\Models\Countries;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function get()
    {
        return Countries::orderBy('id', 'DESC')->get();
    }
    public function add(Request $request)
    {
        $validate = $request->validate([
            'media' => 'required|mimes:png'
        ]);
        if ($validate) {
            $reqDecode = json_decode($request->data, true);
            $checkCountry = Countries::where('country', $reqDecode['name'])->first();

            if ($checkCountry == null) {
                $filename = $reqDecode['name'] . '.' . $request->media->getClientOriginalExtension();
                $file_path = $request->file('media')->storeAs('/countries/', $filename, 'public');

                Countries::create([
                    'country' => $reqDecode['name'],
                    'icon' => $filename
                ]);
            } else {
                return response()->json(['alert' => 'موجودة مسبقاً'], 404);
            }
        }
    }
    public function delete(Request $request)
    {
        Countries::where('id', $request->id)->delete();
    }
}
