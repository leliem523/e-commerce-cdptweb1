<?php

use App\Http\Controllers\SinglePageController;
use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\CartController;
// use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\ProductController;
// use Illuminate\Support\Facades\Route;

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

Route::get('{path?}', SinglePageController::class)->where('path', '([\w!@#%$^&*)\'\"(+=._\-\/_.]+)?')->name('spa');
// Route::get('{path?}', SinglePageController::class);
// Route::get('/{path?}/{slug?}', SinglePageController::class);
