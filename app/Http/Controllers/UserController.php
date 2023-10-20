<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function UserDashboard() {

        $id = Auth::user()->id;
        $userData = User::find($id);
        return view("dashboard", compact("userData"));
    }//end function

    public function UserProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->phone = $request->phone;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/user_images'.$data->photo));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $fileName);
            $data['photo'] = $fileName;
        }

        $data->save();
        
        $notification = array(
            'message' => 'Données utilisateur enregistrées avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }//end function

    public function UserDestroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Vous vous etes déconnecté avec succès',
            'alert-type' => 'success'
        );
        return redirect('/login')->with($notification);
    }//end function
}
