<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DemoController extends Controller
{
    function DemoAction(){
        return User::with('profile')->get();
    }
}
