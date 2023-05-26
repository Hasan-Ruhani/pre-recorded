<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DemoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response              
    {
        // $key = $request -> header('API-KEY');                                   //no 21
        // if($key == "xyz123"){
        //     return $next($request);
        // }
        // else{
        //     return response() -> json('unauthorized', 401);
        // }

        $auth = $request -> auth;                                                 //no 22
        if($auth == "123"){
            return $next($request);
        }
        else{
            return redirect('/login');
        }
    }
}
