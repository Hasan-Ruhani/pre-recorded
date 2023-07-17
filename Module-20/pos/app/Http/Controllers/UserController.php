<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
}
