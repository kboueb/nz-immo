<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Category;
use Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function AllProducts(){
        $product = Product::latest()->get();
        return view('backend.product.all_products',compact('product'));
    }

    public function AddProduct(){
        $seller = User::where('status','active')->where('role','seller')->latest()->get();
        $cat = Category::latest()->get();
        return view('backend.product.add_product', compact('cat', 'seller'));
    }

    public function AddProductStore(Request $request){
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('upload/product/thumbnail/'.$name_gen);
        $save_url = 'upload/product/thumbnail/'.$name_gen;

        $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'seller_id' => $request->seller_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),
            'product_desc' => $request->product_desc,
            'product_price' => $request->product_price,
            'product_thumbnail' => $save_url,
            'special_deal' => $request->special_deal,
            'product_status' => 1,
            'created_at' => Carbon::now(),
        ]);

        // Multi images
        $images = $request->file('multi_img');
        foreach ($images as $key => $image) {
            # code...
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(800,800)->save('upload/product/multi_images/'.$name_gen);
            $save_url = 'upload/product/multi_images/'.$name_gen;
        }

        MultiImg::insert([
            'product_id' => $product_id,
            'photo_name' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Annonce enregistrée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.products')->with($notification);
    }
}
