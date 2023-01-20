<?php

namespace App\Http\Controllers;

use App\Models\Subscriptions;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function get()
    {
        return Subscriptions::orderBy('id', 'DESC')->with('user')->get();
    }
    public function delete($id)
    {
        return Subscriptions::where('id', $id)->delete();
    }
}
