<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

// Home
Route::get('/home', function () {
    return view('\Home\index');
});
// Root
Route::get('/', function () {
    return view('\Home\index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

//GET /index
Route::get('/index', [ItemsController::class,'index'])->middleware('auth');
//POST /add
Route::post('/add', [ItemsController::class,'add'])->middleware('auth');
//GET /edit/1
Route::get('/edit/{id}', [ItemsController::class,'edit'])->middleware('auth');
//POST /save
Route::post('/save',[ItemsController::class,'save'])->middleware('auth');
//GET /delete/1
Route::get('/delete/{id}', [ItemsController::class,'delete'])->middleware('auth');

require __DIR__.'/auth.php';
