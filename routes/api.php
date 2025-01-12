<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

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

// http://127.0.0.1:8000/api/product/list (GET)
Route::get('product/list',[RouteController::class,'productList']);
// http://127.0.0.1:8000/api/category/list (GET)
Route::get('category/list',[RouteController::class,'categoryList']);
// http://127.0.0.1:8000/api/all/list (GET)
Route::get('all/list',[RouteController::class,'allList']);
// http://127.0.0.1:8000/api/category/create (POST)
// body { name : '' }
Route::post('category/create',[RouteController::class,'categoryCreate']);
// http://127.0.0.1:8000/api/contact/create (POST)
Route::post('contact/create',[RouteController::class,'contactCreate']);
// http://127.0.0.1:8000/api/category/delete (POST)
Route::post('category/delete',[RouteController::class,'categoryDelete']);
// http://127.0.0.1:8000/api/category/get/delete/1 (GET)
Route::get('category/get/delete/{id}',[RouteController::class,'categoryDeleteGET']);
// http://127.0.0.1:8000/api/category/details (POST)
Route::post('category/details',[RouteController::class,'categoryDetails']);
// http://127.0.0.1:8000/api/category/update (POST)
Route::post('category/update',[RouteController::class,'categoryUpdate']);
