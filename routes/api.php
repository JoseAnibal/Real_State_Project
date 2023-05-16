<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertiesController;

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

Route::Post('store_property',[PropertiesController::class,'store']);

Route::patch('update_property/{property}',[PropertiesController::class,'updateApi']);

Route::post('upload_images/{property}',[PropertiesController::class,'uploadImages']);

Route::get('get_coords/{property}',[PropertiesController::class,'coordsProperty']);