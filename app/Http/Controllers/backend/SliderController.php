<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Image;
use Carbon\Carbon;

class SliderController extends Controller
{
    public function AllSlider(){
        $sld = Slider::latest()->get();
        return view('backend.slider.all_slider',compact('sld'));
    }

    public function AddSlider(){
        return view('backend.slider.add_slider');
    }

    public function SliderStore(Request $request){
        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1416,538)->save('upload/slider/'.$name_gen);
        $save_url = 'upload/slider/'.$name_gen;

        $slider_id = Slider::insertGetId([
            'slider_title' => $request->slider_title,
            'slider_subtitle' => $request->slider_subtitle,
            'slider_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Slide enregistré avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification);
    }

    public function EditSlider($id){
        $sld = Slider::findOrFail($id);
        return view('backend.slider.edit_slider', compact('sld'));
    }

    public function UpdateSlider(Request $request){
        $slider = $request->id;
        $old_img = $request->old_img;

        if ($request->file('slider_image')) {
            # code...
        
        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1416,538)->save('upload/slider/'.$name_gen);
        $save_url = 'upload/slider/'.$name_gen;

        if (file_exists($old_img)) {
            # code...
            unlink($old_img);
        }

        Slider::findOrFail($slider)->update([
            'slider_title' => $request->slider_title,
            'slider_subtitle' => $request->slider_subtitle,
            'slider_image' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => "Le slider a été modifiée avec succès",
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification);
    } else {
        Slider::findOrFail($slider)->update([
            'slider_title' => $request->slider_title,
            'slider_subtitle' => $request->slider_subtitle,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => "Le slider a été modifiée sans image avec succès",
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification);
    }
    }

    public function DeleteSlider($id){
        $sld = Slider::findOrFail($id);
        $img = $sld->slider_image;
        $sld->delete();

        $notification = array(
            'message' => 'Slide supprimé avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification);
    }
}
