<?php

use App\Http\Controllers\Api\V1\ApiAuthController;
use App\Http\Controllers\Api\V1\BrandsController;
use App\Http\Controllers\Api\V1\CategoriesController;
use App\Http\Controllers\Api\V1\FilesController;
use App\Http\Controllers\Api\V1\OrdersController;
use App\Http\Controllers\Api\V1\OrderStatusesController;
use App\Http\Controllers\Api\V1\PostsController;
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

//admin routes
Route::prefix('admin')->group(function () {
    Route::get('create', [UsersController::class, 'store']);
    Route::get('logout', [ApiAuthController::class, 'logout']);
    Route::get('user-listing', [UsersController::class, 'index']);
    Route::get('user-edit/{uuid}', [UsersController::class, 'index']);
    Route::get('user-delete/{uuid}', [UsersController::class, 'destroy']);
});

//user end points
Route::get('user/{uuid}', [UsersController::class, 'show']);
Route::delete('user/{uuid}', [UsersController::class, 'destroy']);
Route::get('user/{uuid}/orders', [OrdersController::class, 'getUserOrders']);
Route::get('user/create', [UsersController::class, 'store']);
Route::get('user/login', [ApiAuthController::class, 'logout']);
Route::put('user/edit', [UsersController::class, 'update']);

//main page Routes
Route::prefix('main')->group(function () {
    Route::resource('blog', PostsController::class);
    Route::resource('promotions', PromotionsController::class);
});

//brand Routes
Route::resource('brands', BrandsController::class);


//categories Routes
Route::resource('categories', CategoriesController::class);


//orders Routes
Route::resource('orders', OrdersController::class);
Route::get('/order/{uuid}/download', [OrdersController::class, 'download']);
Route::get('/orders/dashboard', [OrdersController::class, 'dashboardOrders']);
Route::get('/orders/shipment-locator', [OrdersController::class, 'shipmentLocator']);

//order statuses routes
Route::resource('order-statuses', OrderStatusesController::class);


//payments  routes
Route::resource('order-statuses', OrderStatusesController::class);

//products  routes
Route::resource('products', OrderStatusesController::class);


//files  routes
Route::get('/file/upload', [FilesController::class, 'upload']);
Route::get('/file/{uuid}', [FilesController::class, 'show']);
