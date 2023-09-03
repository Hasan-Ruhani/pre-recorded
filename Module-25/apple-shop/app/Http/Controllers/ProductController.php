<?php

namespace App\Http\Controllers;

use App\Helper\ResponseHelper;
use App\Models\CustomerProfile;
use App\Models\ProductSlider;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\ProductReview;
use App\Models\ProductWish;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function ListProductByCategory(Request $request): JsonResponse{
        $data = Product::where('category_id', $request->id)->with('brand', 'category')->get();
        return ResponseHelper::Out('success', $data, 200);
    }

    public function ListProductByRemark(Request $request): JsonResponse{
        $data = Product::where('remark', $request->remark)->with('brand', 'category')->get();
        return ResponseHelper::Out('success', $data, 200);
    }

    public function ListProductByBrand(Request $request): JsonResponse{
        $data = Product::where('brand_id', $request->id)->with('brand', 'category')->get();
        return ResponseHelper::Out('success', $data, 200);
    }

    public function ListProductSlider(Request $request): JsonResponse{
        $data = ProductSlider::all();
        return ResponseHelper::Out('success', $data, 200);
    }

    public function ProductDetailsById(Request $request): JsonResponse{
        $data = ProductDetails::where('product_id', $request->id)->with('product', 'product.brand', 'product.category')->get();
        return ResponseHelper::Out('success', $data, 200);
    }

    public function ListReviewByProduct(Request $request): JsonResponse{
        $data = ProductReview::where('product_id', $request->product_id)->with(['profile'=>function($query){
            $query -> select('id', 'cus_name');
        }]) -> get();
        return ResponseHelper::Out('success', $data, 200);
    }

    public function CreateProductReview(Request $request): JsonResponse{
        $user_id = $request -> header('id');
        $profile = CustomerProfile::where('user_id', $user_id) -> first();

        if($profile){
            $request -> merge(['customer_id' => $profile -> id]);
            $data = ProductReview::updateOrCreate(
                ['customer_id' => $profile -> id, 'product_id' => $request -> input('product_id')],
                $request -> input()
            );
            return ResponseHelper::Out('success', $data, 200);
        }
        else{
            return ResponseHelper::Out('fail', 'Customer Profile Not Exists', 200);
        }
    }

    public function ProductWishList(Request $request): JsonResponse{
        $user_id = $request -> header('id');
        $data = ProductWish::where('user_id', $user_id) -> with('product') -> get();
        return ResponseHelper::Out('success', $data, 200);
    }

    public function CreateWishList(Request $request): JsonResponse{
        $user_id = $request -> header('id');
        $data = ProductWish::updateOrCreate(
            ['user_id' => $user_id, 'product_id' => $request -> product_id],
            ['user_id' => $user_id, 'product_id' => $request -> product_id],
        );
        return ResponseHelper::Out('success', $data, 200);
    }

    public function RemoveWishList(Request $request): JsonResponse{
        $user_id = $request -> header('id');
        $data = ProductWish::where(['user_id' => $user_id, 'product_id' => $request -> product_id]) -> delete();
        return ResponseHelper::Out('success', $data, 200);
    }

    public function CreateCartList(Request $request): JsonResponse{
        $user_id = $request -> header('id');
        
    }
}
