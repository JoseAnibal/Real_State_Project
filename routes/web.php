<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/users', function () {
    return view('Users/form_user');
});

Route::post('/users',[UsersController::class,'store'])->name('user_added');

//PROPIEDADES
Route::get('/properties_form', function () {
    return view('Admin/form_add_property');
});

Route::post('/properties',[PropertiesController::class,'store'])->name('property_added');
