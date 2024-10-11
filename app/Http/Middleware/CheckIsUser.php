<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class CheckIsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, \Closure $next): Response
    {
        if ((Auth::user()->status === 'Admin' || Auth::user()->status === 'admin')
            || (Auth::user()->status === 'Moder' || Auth::user()->status === 'moder')
            || (Auth::user()->status === 'User' || Auth::user()->status === 'user')) {
            return $next($request);
        }

        // return redirect()->route('home');
        return Redirect::back()->withErrors(['msg' => 'You have no authority']);
    }
}
