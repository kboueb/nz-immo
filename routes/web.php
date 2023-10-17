<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ADMIN
Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashoard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');
    
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin']);
Route::get('/seller/login', [SellerController::class, 'SellerLogin']);


// SELLER
Route::middleware(['auth','role:seller'])->group(function(){
    Route::get('/seller/dashboard', [SellerController::class, 'SellerDashboard'])->name('seller.dashboard'); 
    Route::get('/seller/logout', [SellerController::class, 'SellerDestroy'])->name('seller.logout');
    Route::get('/seller/profile', [SellerController::class, 'SellerProfile'])->name('seller.profile');
    Route::post('/seller/profile/store', [SellerController::class, 'SellerProfileStore'])->name('seller.profile.store');
    Route::get('/seller/change/password', [SellerController::class, 'SellerChangePassword'])->name('seller.change.password');
    Route::post('/seller/update/password', [SellerController::class, 'SellerUpdatePassword'])->name('update.password');
});