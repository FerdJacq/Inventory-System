<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
 

Route::get('product', [ProductController::class, 'productVue']);
Route::post('addproduct', [ProductController::class, 'productVue_add']);
Route::delete('delproduct/{id}', [ProductController::class, 'productVue_del']);
Route::get('editproduct/{id}/edit',[ProductController::class, 'productVue_edit']);
Route::post('updateproduct/{id}',[ProductController::class,'productVue_update']);
Route::post('addstock/{$id}',[ProductController::class,'productVue_addStock']);