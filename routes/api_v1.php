<?php

use App\Http\Controllers\Api\V1\ApiAuthController;
use App\Http\Controllers\Api\V1\BrandsController;
use App\Http\Controllers\Api\V1\CategoriesController;
use App\Http\Controllers\Api\V1\OrderStatusesController;
use App\Http\Controllers\Api\V1\PaymentsController;
use App\Http\Controllers\Api\V1\PostsController;
use App\Http\Controllers\Api\V1\ProductsController;
use App\Http\Controllers\Api\V1\PromotionsController;
use App\Http\Controllers\Api\V1\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Auth routes
Route::post('admin/login', [ApiAuthController::class, 'login'])->name('login');
Route::post('user/login', [ApiAuthController::class, 'login']);

Route::group(['middleware' => ['json.response']], function () {
//Route::middleware('auth', 'has_admin_access')->group(function () {
//admin routes
    Route::prefix('admin')->group(function () {
        Route::post('/create', [UsersController::class, 'create'])->name('user.create');
        Route::get('/user-listing', [UsersController::class, 'index'])->name('user.listing');
        Route::get('/user-show/{uuid}', [UsersController::class, 'show'])->name('user.show');
        Route::put('/user-edit/{uuid}', [UsersController::class, 'update'])->name('user.edit');
        Route::delete('/user-delete/{uuid}', [UsersController::class, 'destroy'])->name('user.delete');
    });
//});

//Route::middleware('auth', 'has_user_access')->group(function () {

//main page Routes
    Route::prefix('main')->group(function () {
        Route::get('/blog', [PostsController::class, 'index'])->name('blogs.index');
        Route::get('/blog/{uuid}', [PostsController::class, 'show'])->name('blog.show');
        Route::get('/promotions', [PromotionsController::class,'index'])->name('promotions.index');
    });

//brand Routes
    Route::get('brands', [BrandsController::class, 'index'])->name('brands.index');
    Route::post('brand/create', [BrandsController::class, 'create'])->name('brand.create');
    Route::get('brand/{brand_uuid}', [BrandsController::class, 'show'])->name('brand.show');
    Route::put('brand/{brand_uuid}', [BrandsController::class, 'update'])->name('brand.update');
    Route::delete('brand/{brand_uuid}', [BrandsController::class, 'destroy'])->name('brand.delete');

//categories Routes
    Route::get('categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::get('category/create', [CategoriesController::class, 'create'])->name('category.create');
    Route::get('category/{category_uuid}', [CategoriesController::class, 'show'])->name('category.show');
    Route::put('category/{category_uuid}', [CategoriesController::class, 'update'])->name('category.update');
    Route::delete('category/{category_uuid}', [CategoriesController::class, 'destroy'])->name('category.delete');


//order statuses routes

    Route::get('order-statuses', [OrderStatusesController::class, 'index'])->name('order-statuses.index');
    Route::post('order-status/create', [OrderStatusesController::class, 'create'])->name('order-status.create');
    Route::get('order-status/{order_status_uuid}', [OrderStatusesController::class, 'show'])->name('order-status.show');
    Route::put('order-status/{order_status_uuid}', [OrderStatusesController::class, 'update'])->name('order-status.update');
    Route::delete('order-status/{order_status_uuid}', [OrderStatusesController::class, 'destroy'])->name('order-status.delete');

//payments  routes
    Route::get('payments', [PaymentsController::class, 'index'])->name('payments.index');
    Route::post('payment/create', [PaymentsController::class, 'create'])->name('payment.create');
    Route::get('payment/{payment_uuid}', [PaymentsController::class, 'show'])->name('payment.show');
    Route::put('payment/{payment_uuid}', [PaymentsController::class, 'update'])->name('payment.update');
    Route::delete('payment/{payment_uuid}', [PaymentsController::class, 'destroy'])->name('payment.delete');

//products  routes
    Route::get('products', [ProductsController::class, 'index'])->name('products.index');
    Route::post('product/create', [ProductsController::class, 'create'])->name('products.create');
    Route::get('product/{product_uuid}', [ProductsController::class, 'show'])->name('products.show');
    Route::put('product/{product_uuid}', [ProductsController::class, 'update'])->name('products.update');
    Route::delete('product/{product_uuid}', [ProductsController::class, 'destroy'])->name('products.delete');

});
