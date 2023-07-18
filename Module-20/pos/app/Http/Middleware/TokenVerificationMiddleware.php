<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Helper\JWTToken;

class TokenVerificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('token');                    // recived $token from header method
        $result = JWTToken::VerifyToken($token);               // pass $token form JWTToken mehod that we created JWTToken names

        if($result == 'unauthorized'){
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ], 401);                                 // 401(unauthorized) status code
        }
        else{
            $request->headers->set('email', $result);   // carry on user email for access next steps to user
            return $next($request);
        }
        
    }
}
