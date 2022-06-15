<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLogin
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */


    /*
        handle sẽ nhận tham số $request thông qua đối tượng Request
        $next là dạng object : cho phép request đó được đi qua hay không nếu request đó đi qua thì return $next($request)


    */
    public function handle(Request $request, Closure $next)
    {
        // echo "middleware request<br>";
        //khi có /* thì nó sẽ nhận những url chỉ cần có admin ở đầu ko quan tâm đến đằng sau  ( vd : admin/show-form , admin/login)
        if($request->is('admin/*') || $request->is('admin')){
            echo 'khu vực của trang admin<br>';
        }
        return $next($request);
    }
}
