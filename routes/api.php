<?php

use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\CustomerController;
use App\Http\Controllers\Api\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Api\Admin\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Api\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Admin\SliderController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Api\Customer\InvoiceController as CustomerInvoiceController;
use App\Http\Controllers\Api\Customer\LoginController as CustomerLoginController;
use App\Http\Controllers\Api\Customer\RegisterController;
use App\Http\Controllers\Api\Customer\ReviewController;
use App\Http\Controllers\Api\Web\CategoryController as WebCategoryController;
use App\Http\Controllers\Api\Web\ProductController as WebProductController;
use App\Http\Controllers\Api\Web\SliderController as WebSliderController;
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
    Route::post('/login', [AdminLoginController::class, 'index', ['as' => 'admin']]);

    // group route with middleware "auth:api_admin"
    Route::group(['middleware' => 'auth:api_admin'], function () {
        // data user
        Route::get('/user', [AdminLoginController::class, 'getUser', ['as' => 'admin']]);

        // refresh token JWT
        Route::get('/refresh', [AdminLoginController::class, 'refreshToken', ['as' => 'admin']]);

        // logout
        Route::post('/logout', [AdminLoginController::class, 'logout', ['as' => 'admin']]);

        // dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index', 'as' => 'admin']);

        // categories resource
        Route::apiResource('/categories', CategoryController::class, ['except' => ['create', 'edit'], 'as' => 'admin']);

        //products resource
        Route::apiResource('/products', ProductController::class, ['except' => ['create', 'edit'], 'as' => 'admin']);

        //invoices resource
        Route::apiResource('/invoices', AdminInvoiceController::class, ['except' => ['create', 'store', 'edit', 'update', 'destroy'], 'as' => 'admin']);

        //customer
        Route::get('/customers', [CustomerController::class, 'index', ['as' => 'admin']]);

        //sliders resource
        Route::apiResource('/sliders', SliderController::class, ['except' => ['create', 'show', 'edit', 'update'], 'as' => 'admin']);

        //users resource
        Route::apiResource('/users', UserController::class, ['except' => ['create', 'edit'], 'as' => 'admin']);

    });

});

Route::prefix('customer')->group(function () {
    //route register
    Route::post('/register', [RegisterController::class, 'store'], ['as' => 'customer']);

    //route login
    Route::post('/login', [CustomerLoginController::class, 'index'], ['as' => 'customer']);

    // group route with middleware "auth:api_customer"
    Route::group(['middleware' => 'auth:api_customer'], function () {
        // data user
        Route::get('/user', [CustomerLoginController::class, 'getUser'], ['as' => 'customer']);

        // refresh token JWT
        Route::get('/refresh', [CustomerLoginController::class, 'refreshToken'], ['as' => 'customer']);

        // logout
        Route::get('/logout', [CustomerLoginController::class, 'logout'], ['as' => 'customer']);

        // dashboard
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'], ['as' => 'customer']);

        //invoices resource
        Route::apiResource('/invoices', CustomerInvoiceController::class, ['except' => ['create', 'store', 'edit', 'update', 'destroy'], 'as' => 'customer']);

        //review
        Route::post('/reviews', [ReviewController::class, 'store'], ['as' => 'customer']);

    });
});

//group route with prefix "web"
Route::prefix('web')->group(function () {

    //categories resource
    Route::apiResource('/categories', WebCategoryController::class, ['except' => ['create', 'store', 'edit', 'update', 'destroy'], 'as' => 'web']);

    //products resource
    Route::apiResource('/products', WebProductController::class, ['except' => ['create', 'store', 'edit', 'update', 'destroy'], 'as' => 'web']);

    //sliders route
    Route::get('/sliders', [WebSliderController::class, 'index'], ['as' => 'web']);

});
