<?php

use App\Http\Controllers\AuthController;
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
    return view('app');
});

Route::get('/users', function () {
    return view('Users/form_user');
});

Route::post('/users',[UsersController::class,'store'])->name('user_added');

//PROPIEDADES
Route::get('/properties_form', function () {
    return view('Properties/form_add_property');
});

// Route::post('/properties',[PropertiesController::class,'store'])->name('property_added');

Route::resource('properties',PropertiesController::class);

Route::get('/loginform',[AuthController::class,'showLoginForm'])->name('loginform');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    //AQUI SE SUPONE QUE PONGO LAS RUTAS EN LAS QUE EL USUARIO DEBE ESTAR AUTORIZADO
});