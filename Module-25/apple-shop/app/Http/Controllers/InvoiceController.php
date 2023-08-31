<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function PolicyType(Request $request){
        return Policy::where('type', $request -> type)->first();
    }
}
