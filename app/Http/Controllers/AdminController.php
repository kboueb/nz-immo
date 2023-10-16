<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function AdminDashoard() {
        return view("admin.admin_dashoard");
    }
}
