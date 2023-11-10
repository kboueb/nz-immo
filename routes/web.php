<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\SellerProductConttroller;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\frontend\DemandeReservationController;
use App\Http\Controllers\frontend\IndexController;
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
    Route::get('/reservation/{id}', [DemandeReservationController::class, 'AddReservation'])->name('add.reservation');
    Route::post('/send/reservation/', [DemandeReservationController::class, 'StoreReservation'])->name('store.reservation');
    Route::post('/send/demande/', [DemandeReservationController::class, 'StoreDemande'])->name('store.demande');
    Route::get('/demande/{id}', [DemandeReservationController::class, 'AddDemande'])->name('add.demande');
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
        Route::get('/show/product/{id}', 'ShowProduct')->name('product.show');
        Route::post('/product/store', 'AddProductStore')->name('product.store');
        Route::post('update/product', 'UpdateProduct')->name('product.update');
        Route::post('update/product/thumbnail', 'UpdateProductThumbnail')->name('product.thumbnail.update');
        Route::post('update/product/multi-img', 'UpdateProductThumbnail')->name('product.multiimg.update');
        Route::get('/delete/product/{id}', 'DeleteProduct')->name('product.delete');
    });
    
    // Slider
    Route::controller(SliderController::class)->group(function(){
        Route::get('/all/slider', 'AllSlider')->name('all.slider');
        Route::get('/add/slider', 'AddSlider')->name('add.slider');
        Route::get('/edit/slider/{id}', 'EditSlider')->name('slider.edit');
        Route::post('/slider/store', 'SliderStore')->name('slider.store');
        Route::post('update/slider', 'UpdateSlider')->name('slider.update');
        Route::get('/delete/slider/{id}', 'DeleteSlider')->name('slider.delete');
    });


    Route::controller(DemandeReservationController::class)->group(function(){
        Route::get('/all/demandes', 'AllDemandes')->name('all.demandes');
        Route::get('/all/reservation', 'AllReservations')->name('all.reservations');
        
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

        // Products (Les annonces)
        Route::controller(SellerProductConttroller::class)->group(function(){
            Route::get('/seller/all/products', 'AllProducts')->name('seller.all.products');
            Route::get('/seller/add/product', 'AddProduct')->name('seller.add.product');
            Route::get('/seller/edit/product/{id}', 'EditProduct')->name('seller.product.edit');
            Route::get('/seller/show/product/{id}', 'ShowProduct')->name('seller.product.show');
            Route::post('/seller/product/store', 'AddProductStore')->name('seller.product.store');
            Route::post('/seller/update/product', 'UpdateProduct')->name('seller.product.update');
            Route::post('/seller/update/product/thumbnail', 'UpdateProductThumbnail')->name('seller.product.thumbnail.update');
            Route::post('/seller/update/product/multi-img', 'UpdateProductThumbnail')->name('seller.product.multiimg.update');
            Route::get('/seller/delete/product/{id}', 'DeleteProduct')->name('seller.product.delete');
        });
});


Route::get('/admin/login', [AdminController::class, 'AdminLogin']);
Route::get('/seller/login', [SellerController::class, 'SellerLogin'])->name('login.seller');
Route::get('/become/seller', [SellerController::class, 'BecomeSeller'])->name('become.seller');
Route::post('/seller/register', [SellerController::class, 'RegisterSeller'])->name('register.seller');

Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
 