<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    //

    public function SellerDashboard(){
        return view('seller.index');
    }
    public function SellerLogin() {
        return view("seller.seller_login");
    }//end function

    public function SellerProfile() {

        $id = Auth::user()->id;
        $sellerData = User::find($id);
        return view("seller.seller_profile_view", compact("sellerData"));
    }//end function

    public function SellerProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->phone = $request->phone;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/seller_images'.$data->photo));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/seller_images'), $fileName);
            $data['photo'] = $fileName;
        }

        $data->save();
        
        $notification = array(
            'message' => 'Données Seller enregistrées avec succès',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }//end function

    public function SellerDestroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/seller/login');
    }//end function

    public function SellerChangePassword(Request $request)
    {
        return view('seller.seller_change_password');
    }//end function

    public function SellerUpdatePassword(Request $request)
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

    public function BecomeSeller(){
        return view('auth.become_seller');
    }

    public function RegisterSeller(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'phone' => $request->phone,
            'seller_join' => $request->seller_join,
            'password' => Hash::make($request->password),
            'role' => 'seller',
            'status' => 'inactive',
        ]);
 
        $notification = array(
            'message' => 'Connecté avec succès',
            'alert-type' => 'success'
        );

        return redirect()->route('login.seller')->with($notification);
    }
}
