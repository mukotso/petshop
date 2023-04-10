<?php

use App\Http\Controllers\Api\V1\ApiAuthController;
use App\Http\Controllers\Api\V1\BrandsController;
use App\Http\Controllers\Api\V1\CategoriesController;
use App\Http\Controllers\Api\V1\FilesController;
use App\Http\Controllers\Api\V1\OrdersController;
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
Route::post('admin/login', [ApiAuthController::class, 'login']);
Route::post('user/login', [ApiAuthController::class, 'login']);
Route::get('user/forgot-password', [ApiAuthController::class, 'forgotPassword']);
Route::post('user/reset-password-token', [ApiAuthController::class, 'resetPassword']);


Route::middleware('auth', 'has_admin_access')->group(function () {
//admin routes
    Route::prefix('admin')->group(function () {
        Route::get('/create', [UsersController::class, 'store']);
        Route::get('/logout', [ApiAuthController::class, 'logout']);
        Route::get('/user-listing', [UsersController::class, 'index']);
        Route::get('/user-edit/{uuid}', [UsersController::class, 'index']);
        Route::get('/user-delete/{uuid}', [UsersController::class, 'destroy']);
    });
});

Route::middleware('auth', 'has_user_access')->group(function () {
//user end points
    Route::get('/user/{uuid}', [UsersController::class, 'show']);
    Route::delete('/user/{uuid}', [UsersController::class, 'destroy']);
    Route::get('/user/{uuid}/orders', [OrdersController::class, 'getUserOrders']);
    Route::get('/user/create', [UsersController::class, 'store']);
    Route::get('/user/login', [ApiAuthController::class, 'logout']);
    Route::put('/user/edit', [UsersController::class, 'update']);

//main page Routes
    Route::prefix('main')->group(function () {
        Route::get('/blog', [PostsController::class, 'index']);
        Route::get('/blog/{uuid}', [PostsController::class, 'show']);
        Route::get('/promotions', [PromotionsController::class,'index']);
    });

//brand Routes
    Route::get('brands', [BrandsController::class, 'index']);
    Route::get('brand/create', [BrandsController::class, 'create']);
    Route::get('brand/{brand_uuid}', [BrandsController::class, 'show']);
    Route::put('brand/{brand_uuid}', [BrandsController::class, 'update']);
    Route::delete('brand/{brand_uuid}', [BrandsController::class, 'destroy']);

//categories Routes
    Route::get('categories', [CategoriesController::class, 'index']);
    Route::get('category/create', [CategoriesController::class, 'create']);
    Route::get('category/{category_uuid}', [CategoriesController::class, 'show']);
    Route::put('category/{category_uuid}', [CategoriesController::class, 'update']);
    Route::delete('category/{category_uuid}', [CategoriesController::class, 'destroy']);

//orders Routes

    Route::get('orders', [OrdersController::class, 'index']);
    Route::get('order/create', [OrdersController::class, 'create']);
    Route::get('order/{order_uuid}', [OrdersController::class, 'show']);
    Route::put('order/{order_uuid}', [OrdersController::class, 'update']);
    Route::delete('order/{order_uuid}', [OrdersController::class, 'destroy']);

    Route::get('/order/{order_uuid}/download', [OrdersController::class, 'downloadOrder']);
    Route::get('/orders/dashboard', [OrdersController::class, 'dashboardOrderDetails']);
    Route::get('/orders/shipment-locator', [OrdersController::class, 'shipmentLocators']);

//order statuses routes

    Route::get('order-statuses', [OrderStatusesController::class, 'index']);
    Route::get('order-status/create', [OrderStatusesController::class, 'create']);
    Route::get('order-status/{order-status_uuid}', [OrderStatusesController::class, 'show']);
    Route::put('order-status/{order-status_uuid}', [OrderStatusesController::class, 'update']);
    Route::delete('order-status/{order-status_uuid}', [OrderStatusesController::class, 'destroy']);

//payments  routes
    Route::get('payments', [PaymentsController::class, 'index']);
    Route::get('payment/create', [PaymentsController::class, 'create']);
    Route::get('payment/{payment_uuid}', [PaymentsController::class, 'show']);
    Route::put('payment/{payment_uuid}', [PaymentsController::class, 'update']);
    Route::delete('payment/{payment_uuid}', [PaymentsController::class, 'destroy']);

//products  routes
    Route::get('products', [ProductsController::class, 'index']);
    Route::get('product/create', [ProductsController::class, 'create']);
    Route::get('product/{product_uuid}', [ProductsController::class, 'show']);
    Route::put('product/{product_uuid}', [ProductsController::class, 'update']);
    Route::delete('product/{product_uuid}', [ProductsController::class, 'destroy']);

//files  routes
    Route::get('/file/upload', [FilesController::class, 'upload']);
    Route::get('/file/{uuid}', [FilesController::class, 'show']);
});
