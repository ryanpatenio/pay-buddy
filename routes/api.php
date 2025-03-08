<?php

use App\Http\Controllers\ApiKeysController;
use App\Http\Controllers\ApiRequestController;
use App\Http\Controllers\AuthController;
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
Route::middleware('validateApiKey')->group(function(){

    Route::get('/check-balance',[ApiRequestController::class,'checkBalance']);
    Route::post('/credit',[ApiRequestController::class,'credit']);
    Route::post('/debit',[ApiRequestController::class,'debit']);
    Route::get('/userTransactions',[ApiRequestController::class,'userTransactions']);

});

#for future purposes
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
