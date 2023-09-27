<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{

    public function PolicyPage()
    {
        return view('pages.policy-page');
    }


    function PolicyByType(Request $request){
      return Policy::where('type','=',$request->type)->first();
    }
}
