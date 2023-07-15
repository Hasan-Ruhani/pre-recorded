<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Product;

class demoController extends Controller
{
    function demoAction(Request $request){

        // return Brand::create($request->input());   //for create data

        // return Brand::where('id', $request->id)->update($request->input());   //for update data

        // return Brand::updateOrCreate(                   //for create or update data
        //     ['brandName' => $request->brandName],
        //     $request->input()
        // );

        // return Brand::where('id', $request->id)->delete();   //for delete data

        // return Brand::find(3);     //for find any id data

        // return Product::pluck('title');    //find any column

        // return Product::select('price', 'title', 'star')->get();    //show selected value

        return Product::select('title')->distinct()->get();    //show only unique value like title

    }
}
