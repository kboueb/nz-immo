<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\MultiImg;
use App\Models\Category;
use Image;
use Carbon\Carbon;

class SellerProductConttroller extends Controller
{
    public function AllProducts(){
        $user_id = Auth::user()->id;
        $product = Product::where("seller_id", $user_id)->latest()->get();
        return view('seller.backend.product.all_products',compact('product'));
    }

    public function AddProduct(){
        // $user_id = Auth::user()->id;
        $seller = Auth::user()->name;
        $cat = Category::latest()->get();
        return view('seller.backend.product.add_product', compact('cat', 'seller'));
    }


    public function AddProductStore(Request $request){
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('upload/product/thumbnail/'.$name_gen);
        $save_url = 'upload/product/thumbnail/'.$name_gen;

        $product_id = Product::insertGetId([
            'category_id' => $request->category_id,
            'seller_id' => Auth::user()->id,
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
        foreach ($images as $img) {
            # code...
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(800,800)->save('upload/product/multi_images/'.$make_name);
            $uploadPath = 'upload/product/multi_images/'.$make_name;
        }

        MultiImg::insert([
            'product_id' => $product_id,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Annonce enregistrée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('seller.all.products')->with($notification);
    }

    public function EditProduct($id){
        $multi_img = MultiImg::where('product_id', $id)->get();         
        $seller = Auth::user()->name;
        $cat = Category::latest()->get();
        $product = Product::findOrFail($id);
        return view('seller.backend.product.edit_product', compact('product', 'cat', 'seller', 'multi_img'));
    }

    public function UpdateCategory(Request $request){
        $cat_id = $request->id;
        Category::findOrFail($cat_id)->update([
            'cat_name' => $request->cat_name,
            'cat_slug' => strtolower(str_replace(' ','-',$request->cat_name)),
        ]);

        $notification = array(
            'message' => 'Catégorie modifiée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.categories')->with($notification);
    }

    public function UpdateProduct(Request $request){
        $product = $request->id;
        Product::findOrFail($product)->update([
            'category_id' => $request->category_id,
            'seller_id' => Auth::user()->id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),
            'product_desc' => $request->product_desc,
            'product_price' => $request->product_price,
            // 'product_thumbnail' => $save_url,
            'special_deal' => $request->special_deal,
            'product_status' => 1,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Annonce modifiée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('seller.all.products')->with($notification);
    }

    public function UpdateProductThumbnail(Request $request){
        $product = $request->id;
        $old_img = $request->old_img;

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('upload/product/thumbnail/'.$name_gen);
        $save_url = 'upload/product/thumbnail/'.$name_gen;

        if (file_exists($old_img)) {
            # code...
            unlink($old_img);
        }

        Product::findOrFail($product)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => "L'image principale a été modifiée avec succès",
            'alert-type' => 'success'
        );

        return redirect()->route('seller.all.products')->with($notification);

    }

}
