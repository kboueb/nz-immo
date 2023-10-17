<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function AdminDashoard() {
        return view("admin.index");
    }//end function

    public function AdminLogin() {
        return view("admin.admin_login");
    }//end function

    public function AdminProfile() {

        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view("admin.admin_profile_view", compact("adminData"));
    }//end function

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->phone = $request->phone;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images'.$data->photo));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $fileName);
            $data['photo'] = $fileName;
        }

        $data->save();
        
        $notification = array(
            'message' => 'Données Admin enregistrées avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }//end function

    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }//end function

    public function AdminChangePassword(Request $request)
    {
        return view('admin.admin_change_password');
    }//end function

    public function AdminUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        // Check du mot de passe 
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with('error', "Le mot de passe n'est pas bon!");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('status', "Mot de passe changé avec succèss!");
    }//end function
}
