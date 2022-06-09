<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function get()
    {
        return Notifications::orderBy('id', 'DESC')->get();
    }
    public function getAll()
    {
        return Notifications::orderBy('id', 'DESC')->get();
    }
    public function delete(Request $request)
    {
        Notifications::where('id', $request->id)->delete();
    }
    public function add(Request $request)
    {
        $validate = $request->validate([
            'media' => 'required|mimes:jpeg,png,jpg'
        ]);
        if ($validate) {
            $reqDecode = json_decode($request->data, true);

            $filename = time() . '.' . $request->media->getClientOriginalExtension();
            $file_path = $request->file('media')->storeAs('/notifications/', $filename, 'public');

            Notifications::create([
                'subject' => $reqDecode['subject'],
                'content' => $reqDecode['content'],
                'date' => $reqDecode['date'],
                'country' => $reqDecode['country'],
                'appearance_for' => $reqDecode['appear_for'],
                'appearance_as' => $reqDecode['appear_as'],
                'redirect' => $reqDecode['redirect'],
                'schedule' => $reqDecode['schedule'],
                'media' => $filename
            ]);
        }
    }
}
