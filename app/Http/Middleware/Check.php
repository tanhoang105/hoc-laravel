<?php

namespace App\Http\Middleware;
 

use Closure;
use Illuminate\Http\Request;
class Check
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
            // $homeUrl = route('home');
            // hàm chuyển hướng đến url home
            // return redirect($homeUrl);

            // sử dụng luôn url hiện tại 
        return $next($request);
    }
}
