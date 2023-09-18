<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeContorller extends Controller
{
    public function HomePage(){
        return view('pages.home-page');
    }
}
