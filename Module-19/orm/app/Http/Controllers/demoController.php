<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class demoController extends Controller
{
    function demoAction(Request $request){
        return Brand::create($request->input());
    }
}
