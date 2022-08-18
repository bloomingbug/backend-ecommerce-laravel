<?php

use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\CustomerController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\InvoiceController;
use App\Http\Controllers\Api\Admin\LoginController;
use App\Http\Controllers\Api\Admin\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// group route with prefix "admin"
Route::prefix('admin')->group(function () {
    // route login
    Route::post('/login', [LoginController::class, 'index', ['as' => 'admin']]);

    // group route with middleware "auth:api_admin"
    Route::group(['middleware' => 'auth:api_admin'], function () {
        // data user
        Route::get('/user', [LoginController::class, 'getUser', ['as' => 'admin']]);

        // refresh token JWT
        Route::get('/refresh', [LoginController::class, 'refreshToken', ['as' => 'admin']]);

        // logout
        Route::post('/logout', [LoginController::class, 'logout', ['as' => 'admin']]);

        // dashboard
        Route::get('/dashboard', [DashboardController::class, 'index', 'as' => 'admin']);

        // categories resource
        Route::apiResource('/categories', CategoryController::class, ['except' => ['create', 'edit'], 'as' => 'admin']);

        //products resource
        Route::apiResource('/products', ProductController::class, ['except' => ['create', 'edit'], 'as' => 'admin']);

        //invoices resource
        Route::apiResource('/invoices', InvoiceController::class, ['except' => ['create', 'store', 'edit', 'update', 'destroy'], 'as' => 'admin']);

        //customer
        Route::get('/customers', [CustomerController::class, 'index', ['as' => 'admin']]);

    });

});
