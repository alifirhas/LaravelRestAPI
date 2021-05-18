<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//Route Product

Route::prefix('products')->group(function () {
    //Public
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{product}', [ProductController::class, 'show']);
    Route::get('/search/{name}', [ProductController::class, 'search']);

    //Protected
    Route::group(["middleware" => ['auth:sanctum']], function(){
        Route::post('/', [ProductController::class, 'store']);
        Route::put('/{product}', [ProductController::class, 'update']);
        Route::delete('/{product}', [ProductController::class, 'destroy']);
    });

});

//Route User
Route::prefix('/users')->group(function () {
    //Public
    Route::post('/register', [RegisterController::class, 'store']);
    Route::post('/login', [LoginController::class, 'index']);

    //Protected
    Route::group(["middleware" => ['auth:sanctum']], function(){
        Route::get('/', [RegisterController::class, 'index']);
        Route::Post('/logout', [LogoutController::class, 'index']);
    });
});
