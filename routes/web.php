<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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
// Route::get('/properties_form', function () {
//     return view('Properties/form_add_property');
// });

Route::get('/home',[HomeController::class,'index'])->name('home');

//ROUTES FOR LOGIN/LOGOUT
Route::get('/login',[AuthController::class,'showLoginForm'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('loginin');
Route::post('/register',[AuthController::class,'registerUser']);
Route::post('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('/register',[AuthController::class,'registerView'])->name('register');

//ROUTES FROM LOGGED USERS
Route::middleware(['auth'])->group(function () {

    //ROUTES FOR ADMINS
    Route::group(['middleware' => 'admin'], function () {
        
        //ROUTES FOR PROPERTIES
        Route::resource('properties',PropertiesController::class);
        
        //ROUTES FOR USERS
        Route::resource('users',UsersController::class);
        Route::post('/add_user/{property}',[PropertiesController::class,'addUser'])->name('properties.adduser');
        Route::post('/delete_user/{property}',[PropertiesController::class,'deleteUser'])->name('properties.deleteuser');

    });

});