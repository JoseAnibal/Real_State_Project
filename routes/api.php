<?php

use App\Http\Controllers\IncidencesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\UsersController;
use Illuminate\Contracts\Auth\UserProvider;

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

Route::post('get_users',[UsersController::class,'getUsers']);

Route::post('delete_user/{user}',[UsersController::class,'deleteAPI']);

Route::post('get_properties',[PropertiesController::class,'getProperties']);

Route::post('delete_property/{property}',[PropertiesController::class,'deletePAPI']);

Route::post('get_norental_users',[PropertiesController::class,'norentalUsers']);

Route::post('process_rental/{property}',[PropertiesController::class,'processRental']);

Route::post('get_incidences',[IncidencesController::class,'getIncidences']);