<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use App\Models\Users;
use Illuminate\Http\Request;

class SupportTicketsController extends Controller
{
    public function get(Request $request)
    {
        if (!$request->id) {
            return Tickets::where('active', 1)->orderBy('id', 'DESC')->with('user')->get();
        } else {
            return Tickets::where('id', $request->id)->first();
        }
    }
    public function close(Request $request)
    {
        Tickets::where('id', $request->id)->update([
            'active' => 0
        ]);
    }
    public function add(Request $request)
    {
        Tickets::create([
            'email' => $request->email,
            'subject' => '',
            'content' => $request->content,
            'date' => date('Y-m-d'),
            'active' => 1
        ]);
    }
}
