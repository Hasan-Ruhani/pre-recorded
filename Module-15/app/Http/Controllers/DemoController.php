<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    function DemoAction(){           //no 21
        return "hello";
    }

    function admin(){                  //no 22
        return "Hi I'm Admin";
    }

    function login(){                  //no 22
        return "Hey please login";
    }
}
