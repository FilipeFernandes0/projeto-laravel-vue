<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CrawlerController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsController;
use Goutte\Client;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/product', ProductsController::class,);

Route::get('/roupa-adidas', [CrawlerController::class, 'getAdidasProducts']);

Route::get('/index', [IndexController::class, 'index']);


Route::get('/category', [CategoryController::class, 'displayCategories']);



Route::get('/category/{categoryId}', [CategoryController::class, 'displayProducts']);

Route::get('/products/{productId}', [ProductController::class, 'singleProduct']);

Route::get('/products/{productId}/offers', [ProductController::class, 'offersProduct']);






