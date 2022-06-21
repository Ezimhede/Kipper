<?php

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

Route::get('items',[ItemController::class, 'index'])->middleware('auth');
Route::get('items/{id}',[ItemController::class, 'show']);
Route::post('items',[Itemcontroller::class, 'store']);
Route::put('items/{id}',[Itemcontroller::class, 'update']);
Route::delete('items/{id}',[Itemcontroller::class, 'delete']);
