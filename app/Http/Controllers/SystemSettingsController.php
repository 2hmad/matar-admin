<?php

namespace App\Http\Controllers;

use App\Models\SystemSettings;
use Illuminate\Http\Request;

class SystemSettingsController extends Controller
{
    public function satellite(Request $request)
    {
        SystemSettings::where('id', 1)->update([
            'satellite_link' => $request->satellite_link
        ]);
    }
    public function affiliate(Request $request)
    {
        SystemSettings::where('id', 1)->update([
            'affiliate_mode' => $request->affiliate_mode
        ]);
    }
    public function getSatellite(Request $request)
    {
        return SystemSettings::where('id', 1)->first('satellite_link');
    }
}
