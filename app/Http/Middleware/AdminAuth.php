<?php

namespace App\Http\Middleware;

use App\Models\Admins;
use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $header = $request->header('token');
        if ($header !== null && $header !== '') {
            $checkAdmin = Admins::where('token', $header)->first();
            if ($checkAdmin !== null) {
                return $next($request);
            } else {
                return response()->json(['alert' => 'Token invalid'], 404);
            }
        } else {
            return response()->json(['alert' => 'Token is missing'], 404);
        }
    }
}
