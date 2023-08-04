<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;

class ProductController extends Controller
{
    function ProductPage(): View{
        return view('pages.dashboard.product-page');
    }

    function CreateProduct(Request $request){
        $user_id = $request->header('id');

        $img = $request->file('img');

        $t = time();
        $file_name = $img->getClientOriginalName();
        $img_name = "{$user_id}-{$t}-{$file_name}";
        $img_url = "uploads/{$img_name}";

        $img -> move(public_path('uploads'), $img_name);

        // save to database
        return Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'unit' => $request->input('unit'),
            'img_url' => $img_url,
            'category_id' => $request->input('category_id'),
            'user_id' => $user_id
        ]);
    }

    function DeleteProduct(Request $request){
        $user_id = $request -> header('id');
        $product_id = $request -> input('id');
        $filePath = $request -> input('file_path');
        File::delete($filePath);
        return Product::where('id', $product_id) -> where('user_id', $user_id) -> delete();
    }

    function ProductByID(Request $request){
        $user_id = $request -> header('id');
        $product_id = $request -> input('id');
        return Product::where('id', $product_id) -> where('user_id', $user_id) -> first();
    }

    function ProductList(Request $request){
        $user_id = $request -> header('id');
        return Product::where('user_id', $user_id) -> get();
    }
    
    function UpdateProduct(Request $request){
        $user_id = $request -> header('id');
        $product_id = $request -> input('id');

        if($request -> hasFile('img')){

            // upload new file/image
            $img = $request -> file('img');
            $t = time();
            $file_name = $img -> getClientOriginalName();
            $img_name = "{$user_id}-{$t}-{$file_name}";
            $img_url = "uploads/{$img_name}";
            $img -> move(public_path('uploads'), $img_name);

            // delete old file/image
            $file_path = $request -> input('file_path');
            File::delete($file_path);

            // update product
            return Product::where('id', $product_id) -> where('user_id', $user_id) -> update([
                'name' => $request -> input('name'),
                'price' => $request -> input('price'),
                'unit' => $request -> input('unit'),
                'img_url' => $img_url, 
                'category_id' => $request -> input('category_id')
            ]);
        }
        else{
            return Product::where('id', $product_id) -> where('user_id', $user_id) -> update([
                'name' => $request -> input('name'),
                'price' => $request -> input('price'),
                'unit' => $request -> input('unit'),
                'category_id' => $request -> input('category_id')
            ]);
        }
        
    }
}
