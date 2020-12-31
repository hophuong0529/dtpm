<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('', [AdminController::class, 'index']);

Route::get('register', [AdminController::class, 'register']);
Route::post('register', [AdminController::class, 'postRegister']);

Route::get('showProduct', [AdminController::class, 'showProduct']);
Route::get('addProduct', [AdminController::class, 'addProduct']);

Route::get('showCart', [AdminController::class, 'showCart']);
Route::get('cart/{action?}/{id?}', [AdminController::class, 'cart']);
Route::post('cart/{action?}/{id?}', [AdminController::class, 'cart']);

Route::get('createBill', [AdminController::class, 'createBill']);
Route::post('createBill', [AdminController::class, 'saveBill']);



