<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Singleton\MyComments;
use App\Singleton\MyLogger;
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

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/products', [ProductController::class, 'index'])->name('get_products');
    Route::get('/categories', [CategoryController::class, 'index'])->name('get_products');
    Route::get('/product/{product_slug}', [ProductController::class, 'show'])->name('get_detail_product');
    Route::get('/search/{key}', [ProductController::class, 'searchByName'])->name('search-product');
    Route::get('/category/{id}', [ProductController::class, 'getByCategory'])->name('get-product-by-category');

    //Api for cart (NEW)
    Route::post('/cart', [UserController::class, 'getItemInCart'])->name('user-cart');
    Route::post('/add-to-cart', [UserController::class, 'addProductToCart'])->name('add-to-cart');
    Route::post('/update-cart', [UserController::class, 'updateProductInCart'])->name('update-cart');
    Route::post('/delete-item-in-cart', [UserController::class, 'removeProductFromCart'])->name('delete-item-in-cart');

    // SOFT DELETE FOR CART
    Route::post('/soft-delete-item-in-cart', [UserController::class, 'softDeleteProductFromCart'])->name('soft-delete-item-in-cart');

    // RECOVER SOFT DELETED PRODUCT IN CART
    Route::post('/recover-item-in-cart', [UserController::class, 'recoverItemInCart'])->name('recover-item-in-cart');

    // EMPTY CART
    Route::post('/empty-cart', [UserController::class, 'emptyCart'])->name('empty-cart');

    // RATE PRODUCTS
    Route::post('/rating/{id}', [ProductController::class, 'ratingProducts'])->where('id', '[0-9]+')->name('rating-products');

    // FILTER PRODUCTS
    Route::post('/products/filter/price', [ProductController::class, 'filterProductByPrice'])->name('filer_products_price');
    Route::post('/products/filter/rate', [ProductController::class, 'filterProductByRatingValue'])->name('filer_products_rating_value');

    // UPDATE USER
    Route::post('/update-user', [UserController::class, 'update'])->name('user-update');
});
