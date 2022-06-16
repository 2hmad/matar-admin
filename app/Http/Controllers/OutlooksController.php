<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\Countries;
use App\Models\Outlook;
use App\Models\OutlookLikes;
use App\Models\OutlooksFiles;
use App\Models\OutlookShares;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class OutlooksController extends Controller
{
    public function get()
    {
        return Outlook::orderBy('id', 'DESC')->with('files', 'comments')->get();
    }
    public function getByCountry($country)
    {
        $getCountry = Countries::where('id', $country)->first();
        if ($getCountry !== null) {
            return Outlook::where('country', $getCountry->country)->with('files', 'comments')->orderBy('id', 'DESC')->get();
        } else {
            return response()->json(['alert' => 'لا توجد بيانات'], 404);
        }
    }
    public function fetch($id)
    {
        return Outlook::where('id', $id)->first();
    }
    public function add(Request $request)
    {
        $validate = $request->validate([
            'files.*' => 'required|mimes:jpeg,png,jpg,mp4,flv,3gp,mov,avi,wmv'
        ]);
        if ($validate) {
            $dataDecode = json_decode($request->data, true);
            Outlook::create([
                'title' => $dataDecode['title'],
                'date' => $dataDecode['date'],
                'country' => $dataDecode['country'],
                'details' => $dataDecode['details'],
                'schedule' => $dataDecode['schedule'],
                'hide' => $dataDecode['hideDate'],
                'likes' => 0,
                'shares' => 0,
            ]);
            $getOutlook = Outlook::where([
                ['title', $dataDecode['title']],
                ['date', $dataDecode['date']],
                ['country', $dataDecode['country']],
                ['details', $dataDecode['details']],
                ['schedule', $dataDecode['schedule']],
                ['hide', $dataDecode['hideDate']],
            ])->first();
            foreach ($request->file('files') as $file) {
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file_path = $file->storeAs('/outlooks/', $filename, 'public');
                OutlooksFiles::updateOrCreate([
                    'outlook_id' => $getOutlook->id,
                    'file' => $filename
                ]);
            }
        }
    }
    public function edit(Request $request)
    {
        Outlook::where('id', $request->id)->update([
            'title' => $request->title,
            'date' => $request->date,
            'country' => $request->country,
            'details' => $request->details,
            'schedule' => $request->schedule,
            'hide' => $request->hideDate,
        ]);
    }
    public function delete(Request $request)
    {
        Outlook::where('id', $request->id)->delete();
        Comments::where('outlook_id', $request->id)->delete();
        OutlooksFiles::where('outlook_id', $request->id)->delete();
        OutlookLikes::where('outlook_id', $request->id)->delete();
        OutlookShares::where('outlook_id', $request->id)->delete();
    }
    public function fetchComments()
    {
        return Comments::orderBy('id', 'DESC')->with(['user', 'outlook'])->get();
    }
    public function reply(Request $request)
    {
        Comments::where('id', $request->comment_id)->update([
            'reply' => $request->reply
        ]);
    }
    public function sendComment(Request $request)
    {
        $user = Users::where('token', $request->header('Authorization'))->first();
        Comments::create([
            'outlook_id' => $request->outlook_id,
            'user_id' => $user->id,
            'comment' => $request->comment,
            'date' => date('Y-m-d')
        ]);
    }
    public function like(Request $request)
    {
        $user = Users::where('token', $request->header('Authorization'))->first();
        OutlookLikes::updateOrCreate([
            'outlook_id' => $request->outlook_id,
            'user_id' => $user->id,
        ]);
    }
    public function delete_unused(Request $request)
    {
        $getExpired = Outlook::where('hide', '<=', date('Y-m-d H:i:s'))->get();
        foreach ($getExpired as $outlook) {
            if ($outlook->hide !== null && $outlook->hide !== '') {
                OutlookLikes::where('outlook_id', $outlook->id)->delete();
                OutlookShares::where('outlook_id', $outlook->id)->delete();
                $get_files = OutlooksFiles::where('outlook_id', $outlook->id)->get();
                foreach ($get_files as $file) {
                    File::delete(public_path() . '/storage/outlooks/' . $file->file);
                    OutlooksFiles::where('id', $file->id)->delete();
                }
                DB::table('outlooks_comments')->where('outlook_id', $outlook->id)->delete();
                Outlook::where('id', $outlook->id)->delete();
            }
        }
    }
}
