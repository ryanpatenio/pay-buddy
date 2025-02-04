<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpressController;
use App\Http\Controllers\Transactions;
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

        Route::get('/user',[AuthController::class,'user'])->name('user');

        #dashboard
        Route::get('/user-dashboard',[DashboardController::class,'index'])->name('user.dashboard');
        Route::get('/user-wallet-balance',[DashboardController::class,'getUserWalletBalance'])->name('user.wallet.balance');
        

        #transactions
        Route::get('/Transactions',function(){
            return view('users.transactions');
        });
        Route::post('/checkAccount',[Transactions::class,'checkAccount']);
        Route::post('/process-transaction',[Transactions::class,'sendMoneyToUser'])->name('sendMoney');
        Route::get('/get-transaction/{id}', [Transactions::class, 'getTransaction']);
        

        Route::get('/Notifications',function(){
            return view('users.notifications');
        
        });
        
        Route::get('/Profile-Account',function(){
            return view('users.profileAccount');
        
        });
        Route::get('/Api-keys',function(){
            return view('users.api-keys');
        
        });

        Route::get('/Xpress-Send',[ExpressController::class,'xpress_index']);

        Route::get('/Xpress-Receipt',function(){
            return view('users.xpress.receipt');
        
        })->name('receipt.page');

        #Bank transfer
        Route::get('/Bank-Transfer',function(){
            return view('users.bankTransfer.bankTransfer');
        });
        
       
        #testing
        Route::get('/balance-data', [DashboardController::class, 'getBalanceData']);
        
        Route::get('/Profile',function(){
            return view('users.profile');
        });

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

#temporary for ADMIN

Route::get('/Dashboard-admin',function(){
    return view('admin.dashboard');

})->name('admin.dashboard');

Route::get('/Dashboard-Transactions',function(){
    return view('admin.transactions');

});
Route::get('/Dashboard-Requests',function(){
    return view('admin.requests');

});
Route::get('/Dashboard-Users',function(){
    return view('admin.users.users');

});
Route::get('/Dashboard-Api-keys',function(){
    return view('admin.user-api-keys');

});
Route::get('/Dashboard-Logs',function(){
    return view('admin.logs');

});
Route::get('/Dashboard-Profile-Account',function(){
    return view('admin.profileAccount');

});

Route::get('/Dashboard-viewUser',function(){
    return view('admin.users.viewUser');

});



#temporary for Users

Route::get('/', function () {
    return view('auth.login');
})->name('login');



#set aside for future purposes/ features loan and investment
// Route::get('/Dashboard-Investors',function(){
//     return view('admin.investors.investors');

// });
// Route::get('/Dashboard-Investor-Details',function(){
//     return view('admin.investors.viewInvestor');

// });