<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
    return view('frontend.index');
});

Route::get('/welcome', [AdminController::class, 'Welcome']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
    Route::post('/dashboard/store', [UserController::class, 'UserProfileStore'])->name('user.dashboard.store');
    Route::get('/dashboard/logout', [UserController::class, 'UserDestroy'])->name('user.logout');
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

    // Backend

    // Categories
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/categories', 'AllCategories')->name('all.categories');
        Route::get('/add/category', 'AddCategories')->name('add.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('category.edit');
        Route::post('/category/store', 'AddCategory')->name('category.store');
        Route::post('update/category', 'UpdateCategory')->name('category.update');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('category.delete');
    });

    // Seller management
    Route::controller(AdminController::class)->group(function(){
        Route::get('/sellers/actives', 'ActiveSellers')->name('seller.active');
        Route::get('/sellers/inactives', 'InactiveSellers')->name('seller.inactive');
        Route::get('/sellers/inactives/{id}', 'InactiveSellersDetails')->name('seller.inactive.details');
        Route::get('/sellers/actives/{id}', 'ActiveSellersDetails')->name('seller.active.details');
        Route::post('/active/sellers', 'InactiveSellersStore')->name('seller.status.active');
        Route::post('/inactive/sellers', 'ActiveSellersStore')->name('seller.status.inactive');
    });

    // Products (Les annonces)
    Route::controller(ProductController::class)->group(function(){
        Route::get('/all/products', 'AllProducts')->name('all.products');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::get('/edit/product/{id}', 'EditProduct')->name('product.edit');
        Route::post('/product/store', 'AddProductStore')->name('product.store');
        Route::post('update/product', 'UpdateProduct')->name('product.update');
        Route::get('/delete/product/{id}', 'DeleteProduct')->name('product.delete');
    });
    
    
});

// SELLER
Route::middleware(['auth','role:seller'])->group(function(){
    Route::get('/seller/dashboard', [SellerController::class, 'SellerDashboard'])->name('seller.dashboard'); 
    Route::get('/seller/logout', [SellerController::class, 'SellerDestroy'])->name('seller.logout');
    Route::get('/seller/profile', [SellerController::class, 'SellerProfile'])->name('seller.profile');
    Route::post('/seller/profile/store', [SellerController::class, 'SellerProfileStore'])->name('seller.profile.store');
    Route::get('/seller/change/password', [SellerController::class, 'SellerChangePassword'])->name('seller.change.password');
    Route::post('/seller/update/password', [SellerController::class, 'SellerUpdatePassword'])->name('update.password');
});


Route::get('/admin/login', [AdminController::class, 'AdminLogin']);
Route::get('/seller/login', [SellerController::class, 'SellerLogin'])->name('login.seller');
Route::get('/become/seller', [SellerController::class, 'BecomeSeller'])->name('become.seller');
Route::post('/seller/register', [SellerController::class, 'RegisterSeller'])->name('register.seller');
