<?php

use App\Http\Controllers\ProductosController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/productos',[ProductosController::class,'show']);

Route::post('/storage',[productosController::class,'storage']);

Route::delete('/delete/{id}',[productosController::class,'delete']);

Route::put('/update/{id}',[productosController::class,'update']);

Route::get('/categorias',[productosController::class,'categoria']);