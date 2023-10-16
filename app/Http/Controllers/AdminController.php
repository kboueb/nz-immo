<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function AdminDashoard() {
        return view("admin.index");
    }

    public function AdminLogin() {
        return view("admin.admin_login");
    }

    public function AdminProfile() {

        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view("admin.admin_profile_view", compact("adminData"));
    }

    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
