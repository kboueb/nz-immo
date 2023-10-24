<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function AllCategories(){
        $cat = Category::latest()->get();
        return view('backend.category.all_categories',compact('cat'));
    }

    public function AddCategories(){
        return view('backend.category.add_categories');
    }

    public function AddCategory(Request $request){
        Category::insert([
            'cat_name' => $request->cat_name,
            'cat_slug' => strtolower(str_replace(' ','-',$request->cat_name)),
        ]);

        $notification = array(
            'message' => 'Catégorie enregistrée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.categories')->with($notification);
    }

    public function EditCategory($id){
        $cat = Category::findOrFail($id);
        return view('backend.category.edit_category', compact('cat'));
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

    public function DeleteCategory($id){
        $cat = Category::findOrFail($id);

        $cat->delete();

        $notification = array(
            'message' => 'Catégorie supprimée avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.categories')->with($notification);
    }
} 
