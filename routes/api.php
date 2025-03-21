<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/products', [ProductController::class, 'store']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'singleProduct']);
Route::put('/products/{id}', [ProductController::class, 'updateProduct']);
Route::delete('/products/{id}', [ProductController::class, 'deleteProduct']);


// category route 
Route::post('/category', [CategoryController::class, 'store']);
Route::get('/category', [CategoryController::class, 'getAllCategory']);
Route::get('/category/{id}', [CategoryController::class, 'getSingelCategory']);
Route::put('/category/{id}', [CategoryController::class, 'updateCategory']);
Route::delete('/category/{id}', [CategoryController::class, 'deleteCategory']);



