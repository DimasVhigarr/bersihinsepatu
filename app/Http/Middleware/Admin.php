<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class Admin
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->isAdmin()) {
            return $next($request);
        }
        return redirect('/')->with('error', 'Akses hanya untuk admin.');

        // if (Auth::check() && Auth::user()->isAdmin()) {
        //     return $next($request);
        // }

        // return redirect('/')->with('error', 'Akses hanya untuk admin.');
    }
}
