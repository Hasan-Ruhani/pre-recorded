<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helper\JWTToken;
use Exception;

class UserController extends Controller
{
    function UserRegistration(Request $request){
        try{
            User::create([
                'firstName' => $request->input('firstName'),
                'lasttName' => $request->input('lasttName'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Your registration successfully'
            ]);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'User Registration Failed'
            ]);
        }
        
    }

    function UserLogin(Request $request){                       //when user data match the database then login successful
        $count = User::where('email', '=', $request->input('email'))
        -> where('password', '=', $request->input('password'))
        -> count();                                //if return count value = 1 that's mean completely match user data

        if($count == 1){
            $token = JWTToken::createToken($request->input('email'));    // we recive jwt token from JWTToken.php file
            return response()->json([
                'status' => 'success',
                'message' => 'User Login Successful',
                'token' => $token
            ]);
        }

        else{
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ]);
        }
    }

    function SendOTPCode(Request $request){
        $email = $request->input('email');              // get user email
        $otp = rand(1000, 9999);                        // generate random otp code

        $count = User::where('email', '=', $email)->count();    // matching user email

        if($count == 1){
            //
        }

        else{
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ]);
        }
    }
}
