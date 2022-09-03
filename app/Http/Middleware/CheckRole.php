<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if(Auth::check() && (($request->user()->roll) == $role)){
            return $next($request);
        }
        return redirect(route('admin.login'))->with('status', 'You are Not Authorized!..');
    }
}
