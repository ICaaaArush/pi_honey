<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class DataEntry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //  IF ADMIN
        if(Auth::user()->role == 'dataentry' || Auth::user()->role == 'supmin'){
            return $next($request);
        }else{
            return back();
        }
    }
}
