<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Helper\JWTToken;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\OTPMail;
use Illuminate\View\View;

class UserController extends Controller
{
    //................................frontend
    function LoginPage():View{
        return view('pages.auth.login-page');
    }

    function RegistrationPage():View{
        return view('pages.auth.registration-page');
    }

    function SendOtpPage(): View{
        return view('pages.auth.send-otp-page');
    }

    function VerifyOTPPage(): View{
        return view('pages.auth.verify-otp-page');
    }

    function ResetPasswordPage(): View{
        return view('pages.auth.reset-pass-page');
    }

//........................backend
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
                'message' => 'User Login Successful'
            ]) -> cookie('token', $token, 60*24*30);      // set token to cookie and set their validity time
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
            //...............send otp to user email
            Mail::to($email)->send(new OTPMail($otp));   // OTPMail location: resource/view/email/OTPMail.blade.php
                                                         // $email - user email
            User::where('email', '=', $email)->update(['otp'=>$otp]);  // update your database otp field

            return response()->json([
                'status' => 'success',
                'message' => '4 digit OTP code has been send to your email'
            ]);
        }

        else{
            return response()->json([
                'status' => 'failed',
                'message' => 'unauthorized'
            ]);
        }
    }

    function verifyOTP(Request $request){
        $email = $request -> input('email');    // get email from user
        $otp = $request -> input('otp');        // get otp code from user

        $count = User::where('email', '=', $email)              // matching email and otp code that get by user
        -> where('otp', '=', $otp) -> count();

        if($count == 1){
            User::where('email', '=', $email)->update(['otp' => '0']);

            $token = JWTToken::CreateTokenForSetPassword($request->input('email'));    // we recive jwt token from JWTToken.php file
            return response()->json([
                'status' => 'success',
                'message' => 'User Verification Successful'
            ], 200) -> cookie('token', $token, 60*24*30);          // token set to cookie
        }
        else{
            return response() -> json([
                'status' => 'faield',
                'message' => 'wrong otp code'
            ]);
        }

    }

    function ResetPassword(Request $request){
        try{
            $email = $request -> header('email');                 // recived email from decoded token
            $password = $request -> input('password');            // recived password from user
            User::where('email', '=', $email)->update(['password' => $password]);     // set new password
                                                                                  // 'email', '=', $email meains user email vs decoded email 
            return response()->json([
                'status' => 'success',
                'messalge' => 'Password reset successful!'
            ]);
        }
        catch(Exception $exception){
            return response()->json([
                'status' => 'failed',
                'messalge' => 'Somthing went wrong'
            ]);
        }
    }
}
