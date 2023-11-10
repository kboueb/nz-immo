<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Category;
use Image;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function ProductDetails($id, $slug  ){
        $multi_img = MultiImg::where('product_id', $id)->get(); 
        $seller = User::where('status','active')->where('role','seller')->latest()->get();
        $cat = Category::latest()->get();
        $product = Product::findOrFail($id);
        return view('frontend.product.details_product', compact('product', 'cat', 'seller', 'multi_img'));
    }
}
