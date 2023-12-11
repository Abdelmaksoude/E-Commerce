<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BrandDataController;
use App\Http\Controllers\MainCategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SideServiceNewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use App\Models\Product;
use App\Models\FavouriteProduct;

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


// Admin Route


// Admin Route
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Route::get('admin/login',[AdminController::class,'Index'])->name('login_form');
        Route::post('admin/login/owner',[AdminController::class,'Login'])->name('admin.login');
        Route::get('admin/dashboard',[AdminController::class,'Dashboard'])->name('admin.dashboard')->middleware('admin');
        Route::get('admin/logout',[AdminController::class,'Logout'])->name('admin.logout')->middleware('admin');
        Route::get('admin/register',[AdminController::class,'Register'])->name('admin.register');
        Route::post('admin/register/owner',[AdminController::class,'RegisterCreate'])->name('admin.register.create');
        Route::get('admin/all',[AdminController::class,'AllAdmins'])->name('all_admins');
        Route::get('admin/all/edit/{id}',[AdminController::class,'Edit'])->name('edit');
        Route::post('admin/all/update/{id}',[AdminController::class,'Update'])->name('update');
        Route::post('admin/all/delete/{id}',[AdminController::class,'Delete'])->name('delete');
        ///////////////////////////////////## profile ##////////////////////////////////////////////
        Route::get('admin/profile/{id}', [AdminProfileController::class,'Show'])->name('adminProfile');
        Route::get('admin/profile/edit/{id}', [AdminProfileController::class,'Edit'])->name('adminProfileEdit');
        Route::post('admin/profile/update/{id}', [AdminProfileController::class,'Update'])->name('adminProfileUpdate');
        ///////////////////////////////////## Slider ##////////////////////////////////////////////
        Route::get('admin_sliders',[SliderController::class,'index'])->name('admin_sliders.index');
        Route::get('admin_sliders/create',[SliderController::class,'create'])->name('admin_sliders.create');
        Route::post('admin_sliders/store',[SliderController::class,'store'])->name('admin_sliders.stpre');
        Route::get('admin_sliders/edit/{id}',[SliderController::class,'edit'])->name('admin_sliders.edit');
        Route::post('admin_sliders/update/{id}',[SliderController::class,'update'])->name('admin_sliders.update');
        Route::get('admin_sliders/delete/{id}',[SliderController::class,'delete'])->name('admin_sliders.delete');
        Route::post('admin_sliders/delete_confirm/{id}',[SliderController::class,'confirmDelete'])->name('admin_sliders.confirm_delete');
        ///////////////////////////////////## Brand ##////////////////////////////////////////////
        // Route::resource('brand', BrandController::class);
        Route::get('brands',[BrandDataController::class,'index'])->name('brand.index');
        Route::get('brand/create',[BrandDataController::class,'create'])->name('brand.create');
        Route::post('brand/store',[BrandDataController::class,'store'])->name('brand.store');
        Route::get('brand/edit/{id}',[BrandDataController::class,'edit'])->name('brand.edit');
        Route::post('brand/update/{id}',[BrandDataController::class,'update'])->name('brand.update');
        Route::post('brand/delete/{id}',[BrandDataController::class,'delete'])->name('brand.delete');
        // Route::get('brands',[BrandDataController::class,'index'])->name('brand.index');
        //////////////////////////////## Category ##///////////////////////////////////////////////////
        Route::get('index',[MainCategoryController::class,'index'])->name('index_category');
        Route::get('create',[MainCategoryController::class,'create'])->name('create_category');
        Route::post('store',[MainCategoryController::class,'store'])->name('store_category');
        Route::get('edit/{id}',[MainCategoryController::class,'edit'])->name('edit_category');
        Route::post('update/{id}',[MainCategoryController::class,'update'])->name('update_category');
        Route::post('delete/{id}',[MainCategoryController::class,'delete'])->name('delete_category');
        ////////////////////////////## subCategory ##/////////////////////////////////////////
        Route::get('sub_category',[SubCategoryController::class,'index'])->name('sub_category.index');
        Route::get('sub_category/create',[SubCategoryController::class,'create'])->name('sub_category.create');
        Route::post('sub_category/store',[SubCategoryController::class,'store'])->name('sub_category.store');
        Route::get('sub_category/edit/{id}',[SubCategoryController::class,'edit'])->name('sub_category.edit');
        Route::post('sub_category/update/{id}',[SubCategoryController::class,'update'])->name('sub_category.update');
        Route::delete('sub_category/delete/{id}',[SubCategoryController::class,'delete'])->name('sub_category.delete');
        //////////////////////////## Side Service ##///////////////////////////////////////////
        Route::resource('side_service', SideServiceNewController::class);
        Route::post('side_service/update', [SideServiceNewController::class,'update'])->name('side-service.update');
        Route::get('side_service/destroy/{id}', [SideServiceNewController::class,'destroy']);
        //////////////////////////## Product ##////////////////////////////////////////////////
        Route::get('products',[ProductController::class,'index'])->name('products.index');

        Route::get('product/create',[ProductController::class,'create'])->name('products.create');
        Route::post('product/store',[ProductController::class,'store'])->name('products.store');

        Route::get('product/edit/{id}',[ProductController::class,'edit'])->name('products.edit');
        Route::post('product/update/{id}',[ProductController::class,'update'])->name('products.update');

        Route::get('product/deleteshowform/{id}',[ProductController::class,'delete'])->name('products.delete');
        Route::post('product/delete/{id}',[ProductController::class,'destroy'])->name('products.destroy');

        Route::get('product/show/{id}',[ProductController::class,'show'])->name('products.show');
        Route::post('product/save/{id}',[ProductController::class,'save_attachment'])->name('product_attachments.store');
        Route::get('/subGategory/{id}',[ProductController::class,'get_sub_gategory']);
        ////////////////////////## site setting ##//////////////////////////////////////////////////
        Route::get('siteSettings',[SiteSettingController::class,'create'])->name('siteSettings.create');
        Route::post('siteSettings/store',[SiteSettingController::class,'store'])->name('siteSettings.store');
        Route::get('siteSettings/edit',[SiteSettingController::class,'edit'])->name('siteSettings.edit');
        Route::post('siteSettings/update/{id}',[SiteSettingController::class,'update'])->name('siteSettings.update');
        ////////////////////////## orders ##////////////////////////////////////////////////////////
        Route::get('orders',[ProductController::class,'orders'])->name('order.index');
    });

// Route::prefix('admin')->group(function(){

// });

//////////////////////////






/////////////////////////////////////






// Route::get('/', function () {
//     return view('dashboard');
// });

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){


Route::get('/',[UserController::class,'index'])->name('home');
Route::get('shop',[UserController::class,'shop'])->name('shop');
Route::get('filter/products', [UserController::class, 'filterProducts'])->name('filter.products');
Route::get('proCategory/{id}',[UserController::class,'productCategory'])->name('producthavesamecategory');
Route::get('details/{id}',[UserController::class,'details'])->name('details');
Route::post('details/review/{id}',[UserController::class,'detailsReview'])->name('detailsreview')->middleware('auth');
Route::get('shoping_cart',[UserController::class,'shoping_cart'])->name('cart');
Route::get('checkout',[UserController::class,'checkout'])->name('checkout');
Route::get('Allavourite',[UserController::class,'Allavourite'])->name('favourite')->middleware('auth');
Route::get('contact',[UserController::class,'contact'])->name('contact');
Route::post('contact/store',[UserController::class,'sendcontact'])->name('sendcontact');
Route::get('shop',[UserController::class,'shop'])->name('shop');

Route::post('Favourite/{id}',[UserController::class,'addFavourite'])->name('addFavourite');
Route::delete('DeleteFavourite/{id}',[UserController::class,'deleteFavourite'])->name('deleteFavourite');
Route::delete('deleteFavouritefromhomepage/{id}',[UserController::class,'deleteFavouritefromhomepage'])->name('deleteFavouritefromhomepage');

// the Cart
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
Route::post('make-order', [CartController::class, 'makeOrder'])->name('make.order');
// end the Cart
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
