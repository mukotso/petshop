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
        Route::get('/create', [UsersController::class, 'store']);
        Route::get('/user-listing', [UsersController::class, 'index']);
        Route::get('/user-edit/{uuid}', [UsersController::class, 'index']);
        Route::get('/user-delete/{uuid}', [UsersController::class, 'destroy']);
    });
//});

//Route::middleware('auth', 'has_user_access')->group(function () {

//main page Routes
    Route::prefix('main')->group(function () {
        Route::get('/blog', [PostsController::class, 'index']);
        Route::get('/blog/{uuid}', [PostsController::class, 'show']);
        Route::get('/promotions', [PromotionsController::class,'index']);
    });

//brand Routes
    Route::get('brands', [BrandsController::class, 'index']);
    Route::post('brand/create', [BrandsController::class, 'create']);
    Route::get('brand/{brand_uuid}', [BrandsController::class, 'show']);
    Route::put('brand/{brand_uuid}', [BrandsController::class, 'update']);
    Route::delete('brand/{brand_uuid}', [BrandsController::class, 'destroy']);

//categories Routes
    Route::get('categories', [CategoriesController::class, 'index']);
    Route::get('category/create', [CategoriesController::class, 'create']);
    Route::get('category/{category_uuid}', [CategoriesController::class, 'show']);
    Route::put('category/{category_uuid}', [CategoriesController::class, 'update']);
    Route::delete('category/{category_uuid}', [CategoriesController::class, 'destroy']);


//order statuses routes

    Route::get('order-statuses', [OrderStatusesController::class, 'index']);
    Route::post('order-status/create', [OrderStatusesController::class, 'create']);
    Route::get('order-status/{order_status_uuid}', [OrderStatusesController::class, 'show']);
    Route::put('order-status/{order_status_uuid}', [OrderStatusesController::class, 'update']);
    Route::delete('order-status/{order_status_uuid}', [OrderStatusesController::class, 'destroy']);

//payments  routes
    Route::get('payments', [PaymentsController::class, 'index']);
    Route::post('payment/create', [PaymentsController::class, 'create']);
    Route::get('payment/{payment_uuid}', [PaymentsController::class, 'show']);
    Route::put('payment/{payment_uuid}', [PaymentsController::class, 'update']);
    Route::delete('payment/{payment_uuid}', [PaymentsController::class, 'destroy']);

//products  routes
    Route::get('products', [ProductsController::class, 'index']);
    Route::post('product/create', [ProductsController::class, 'create']);
    Route::get('product/{product_uuid}', [ProductsController::class, 'show']);
    Route::put('product/{product_uuid}', [ProductsController::class, 'update']);
    Route::delete('product/{product_uuid}', [ProductsController::class, 'destroy']);

});
