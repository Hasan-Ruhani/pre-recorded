<?php

namespace App\Helper;
use Firebase\JWT\key;
use Firebase\JWT\JWT;
use Exception;

class JWTToken{

    public static function CreateToken($userEmail):string {            // "$userEmail" current user email address for the identity 
        $key = env('JWT_KEY');                          // set jwt token that we call .env file

        $payload = [                                    // what data we teken the 'JWT_KEY' that set under the $payload
            'iss' => 'laravel-token',                   // 'iss' means token issue and his name laravel-token
            'iat' => time(),                            // 'iat' means token creaton time
            'exp' => time()+60*60,                      // 'exp' means token expiration time
            'userEmail' => $userEmail                   // for the identity purpose which user currently login this site
        ];

        //....................................encode jwt token
        return JWT::encode($payload, $key, 'HS256');           //'HS256' best algorithm for laravel site
    }


    public static function CreateTokenForSetPassword($userEmail):string {            // "$userEmail" current user email address for the identity 
        $key = env('JWT_KEY');                          // set jwt token that we call .env file

        $payload = [                                    // what data we teken the 'JWT_KEY' that set under the $payload
            'iss' => 'laravel-token',                   // 'iss' means token issue and his name laravel-token
            'iat' => time(),                            // 'iat' means token creaton time
            'exp' => time()+60*20,                      // 'exp' means token expiration time
            'userEmail' => $userEmail                   // for the identity purpose which user currently login this site
        ];

        //....................................encode jwt token
        return JWT::encode($payload, $key, 'HS256');           //'HS256' best algorithm for laravel site
    }
    
    public static function VeriFyToken($token):string {            // decode token

        try{
            $key = env('JWT_KEY');
            $decode = JWT::decode($token, new key($key, 'HS256'));      // here[
                                                                        //  $token = which token we decode
                                                                        //  $key = (secret key) thats key we do encode and decode
                                                                        //  HS256 = encription algorithm
                                                                        // ]
            return $decode->userEmail;      // send decoded key current user email
        }
        catch(Exception $e){
            return 'unauthorized';
        }
        
    }
}