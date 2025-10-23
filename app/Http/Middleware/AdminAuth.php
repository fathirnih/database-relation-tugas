<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('admin_id')) {
            return redirect()->route('admin.login')->with('error', 'Silahkan login dulu.');
        }
        return $next($request);
    }
}
