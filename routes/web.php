<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
#public routes
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::post('/login',[AuthController::class,'login'])->name('login');

Route::middleware(['auth'])->group(function(){

    #user
    Route::middleware('role:user')->group(function(){


    });

    #admin
    Route::middleware('role:admin')->group(function(){


    });
    #super-admin
    Route::middleware('role:super_admin')->group(function(){


    });

    #authenticated routes
    Route::get('/user',[AuthController::class,'user'])->name('myData');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');


});

#temporary
Route::get('/home',function(){
   return view('welcome');
})->name('home');

Route::get('/', function () {
    return view('welcome');
});
