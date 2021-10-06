<?php

use Illuminate\Http\Request;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

// PUBLIC ROUTES FOR GUESTS
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::get('/products', [\App\Http\Controllers\ProductsController::class, 'index']);



//  PROTECTED ROUTES
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::resources([
        '/product_lines' => \App\Http\Controllers\ProductLinesController::class,
        '/products' => \App\Http\Controllers\ProductsController::class,
        '/orders' =>\App\Http\Controllers\OrdersController::class,
        '/customers' =>\App\Http\Controllers\CustomersController::class,
        '/payments' =>\App\Http\Controllers\PaymentsController::class,
        '/employees' =>\App\Http\Controllers\EmployeesController::class,
        '/offices' => \App\Http\Controllers\OfficesController::class
    ]);
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});


