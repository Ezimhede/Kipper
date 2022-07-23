<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\ItemController;
//use App\Http\Controllers\ItemController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Routes for authentication
Route::post('register',[AuthenticationController::class, 'register']);
Route::post('login',[AuthenticationController::class, 'login']);
Route::post('logout',[AuthenticationController::class, 'logout'])->middleware('auth:sanctum');

// Routes for Item Controller
Route::middleware('auth:sanctum')->group(function () {
    Route::get('items',[ItemController::class, 'index']);
    Route::get('items/{id}',[ItemController::class, 'show']);
    Route::post('items',[Itemcontroller::class, 'store']);
    Route::put('items/{id}',[Itemcontroller::class, 'update']);
    Route::delete('items/{id}',[Itemcontroller::class, 'delete']);
});
