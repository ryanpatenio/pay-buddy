<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

#public ulr for redirecting
Route::get('/register',function(){

    return view('auth.register');

})->name('register');



#post Routes
Route::post('/register',[AuthController::class,'register'])->name('process-register');
Route::post('/login',[AuthController::class,'login'])->name('process-login');

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
Route::get('/user-dashboard',function(){
   return view('users.dashboard');
})->name('user-dashboard');

#testing

Route::get('/balance-data', [DashboardController::class, 'getBalanceData']);

Route::get('/Profile',function(){
    return view('users.profile');
});


Route::get('/', function () {
    return view('auth.login');
});

