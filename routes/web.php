<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncidencesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\RegisteredController;
use App\Http\Controllers\RentalsController;
use App\Http\Controllers\UsersController;
use App\Models\Rental;

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
    return redirect()->route('landing.home');
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

Route::get('/propertyshow/{property}',[HomeController::class,'showproperty'])->name('public.showproperty');
Route::get('/propertiesrental',[HomeController::class,'rentalproperties'])->name('public.rentalproperties');
Route::get('/reghome',[HomeController::class,'landing'])->name('landing.home');
Route::get('/whoarewe',[HomeController::class,'whoarewe'])->name('public.whoarewe');

//ROUTES FROM LOGGED USERS
Route::middleware(['auth'])->group(function () {

    //ROUTES FOR ADMINS
    Route::group(['middleware' => 'admin'], function () {
        
        //ROUTES FOR PROPERTIES
        Route::resource('properties',PropertiesController::class);

        Route::get('/property/bills/{property}',[PropertiesController::class,'showbillsadmin'])->name('properties.bills');
        Route::get('/property/bills/create/{property}',[PropertiesController::class,'createbillform'])->name('properties.createbillform');
        Route::get('/property/bills/show/{property}',[PropertiesController::class,'showbilladmin'])->name('properties.showbill');
        Route::post('/property/bills/create/{property}',[PropertiesController::class,'createbill'])->name('properties.createbill');

        //ROUTES FOR INCIDENCES
        Route::resource('incidences',IncidencesController::class);

        Route::get('/showincidencesadmin/{property}',[PropertiesController::class,'showincidencesadmin'])->name('registered.showincidencesadmin');
        
        //ROUTES FOR USERS
        Route::resource('users',UsersController::class);
        Route::get('/user_list/{property}',[PropertiesController::class,'userList'])->name('properties.userlist');
        Route::post('/user_add/{property}',[PropertiesController::class,'userAdd'])->name('properties.useradd');
        Route::resource('rentals',RentalsController::class);

    });

    Route::group(['middleware' => 'registered'], function () {
        Route::get('/registered/{property}',[RegisteredController::class,'index'])->name('registered.index');
        Route::get('/showincidences/{property}',[RegisteredController::class,'showincidences'])->name('registered.showincidences');
        Route::get('/incidences/create/{property}',[RegisteredController::class,'createincidence'])->name('registered.createincidence');
        Route::post('/incidences/store',[RegisteredController::class,'storeincidence'])->name('registered.storeincidence');
        Route::get('/bills/{user}',[RegisteredController::class,'seebills'])->name('registered.seebills');
    });

});