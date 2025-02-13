<?php

use App\Http\Controllers\ApiKeysController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpressController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\Transactions;
use App\Http\Controllers\UserController;
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


#post Routes
Route::post('/register',[AuthController::class,'register'])->name('process-register');
Route::post('/login',[AuthController::class,'login'])->name('process-login');

Route::middleware(['auth'])->group(function(){

    #user
    Route::middleware('role:user')->group(function(){

        Route::get('/user',[AuthController::class,'user'])->name('user');

        #dashboard
        Route::get('/user-dashboard',[DashboardController::class,'index_user'])->name('user.dashboard');
        Route::get('/user-wallet-balance',[DashboardController::class,'getUserWalletBalance'])->name('user.wallet.balance');
        

        #transactions
        Route::get('/Transactions',[Transactions::class,'index_user']);
        Route::post('/checkAccount',[Transactions::class,'checkAccount']);
        Route::post('/process-transaction',[Transactions::class,'sendMoneyToUser'])->name('sendMoney');
        Route::get('/get-transaction/{id}', [Transactions::class, 'getTransaction']);
        
        #Notifications
        Route::get('/Notifications',[NotificationController::class,'notif_index']);
        Route::get('/Notifications/{id}',[NotificationController::class,'getNotification']);
        Route::post('/Notifications-update',[NotificationController::class,'update']);
        
        #Profile
        Route::get('/Profile-Account',[ProfileController::class,'index']);
        Route::patch('/Profile-update',[PRofileController::class,'updateBasicInfo']);
        Route::get('/Profile-email',[ProfileController::class,'getEmail']);
        Route::patch('/Profile-update-email',[ProfileController::class,'updateEmail']);
        Route::patch('/Profile-password-update',[ProfileController::class,'updatePassword']);
        Route::post('/Profile-deactivate',[ProfileController::class,'deactivateAccount']);
        Route::post('/Profile-new-wallet',[ProfileController::class,'addNewWallet']);

        #Requests
        Route::get('/Profile-Request',[RequestsController::class,'index_user']);
        Route::post('/Profile-new-Request',[RequestsController::class,'newRequest']);

        #Api Keys
        Route::middleware(['is_dev'])->group(function(){
            Route::get('/Api-keys',[ApiKeysController::class,'api_index']);
            Route::get('/Api-keys-gen',[ApiKeysController::class,'generateKey']);
            Route::post('/Api-keys-create',[ApiKeysController::class,'createKey']);
        });

        #Xpress Send
        Route::get('/Xpress-Send',[ExpressController::class,'xpress_index']);
        Route::get('/Xpress-Receipt',function(){
            return view('users.xpress.receipt');
        
        })->name('receipt.page');

        #Bank transfer      
        Route::get('/Bank-Transfer-process',[BankController::class,'bankTransfer_index'])->name('bank.transfer');
        Route::get('/Bank-Transfer',[BankController::class,'bank_option_index'])->name('bank.options');
        Route::post('/get-user-selected-balance',[BankController::class,'bankSelected']);
        Route::post('/process-bank-transfer',[BankController::class,'processBankTransfer']);
    
        #testing
        Route::get('/balance-data', [DashboardController::class, 'getBalanceData']);
        
        // Route::get('/Profile',function(){
        //     return view('users.profile');
        // });

    });

    #admin
    Route::middleware(['role:admin|super_admin'])->group(function (){
        #Dashboard
        Route::get('/Dashboard-admin',[DashboardController::class,'index_admin'])->name('admin.dashboard');;
       
        
        #Transactions
        Route::get('/Dashboard-Transactions',[Transactions::class,'index_admin']);
        
        #Request
        Route::get('/Dashboard-Requests',[RequestsController::class,'index_admin']);
        Route::get('/Dashboard-Requests-req/{id}',[RequestsController::class,'getRequestedData']);
        Route::post('/Dashboard-request-approve',[RequestsController::class,'approveRequest']);
        Route::post('/Dashboard-request-decline',[RequestsController::class,'declineRequest']);

        #Users
        Route::get('/Dashboard-Users',[UserController::class,'index']);
        Route::post('/Dashboard-User-create',[UserController::class,'createUser']);
        Route::get('/Dashboard-user-details/{id}',[UserController::class,'showUserDetails']);
        Route::post('/Dashboard-user-updateDetails',[UserController::class,'updateUserDetails']);
        Route::get('/Dashboard-user-email/{id}',[UserController::class,'getEmail']);
        Route::patch('/Dashboard-user-upEmail',[UserController::class,'updateEmail']);
        Route::patch('/Dashboard-user-pass-update',[UserController::class,'updatePassword']);
        Route::post('/Dashboard-user-deactivate',[UserController::class,'deactivateUser']);
        Route::get('/Dashboard-user-status/{id}',[UserController::class,'userStatus']);
        Route::post('/Dashboard-user-activate',[UserController::class,'activateUser']);
        Route::post('/Dashboard-Users-action-status',[UserController::class,'setUserStatus']);
       
        Route::get('/Dashboard-Logs',function(){
            return view('admin.logs');
        
        });
        Route::get('/Dashboard-Profile-Account',function(){
            return view('admin.profileAccount');
        
        });
        
        Route::get('/Dashboard-viewUser',function(){
            return view('admin.users.viewUser');
        
        });

    });
    
    #authenticated routes
    Route::get('/user',[AuthController::class,'user'])->name('myData');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');


});

Route::get('/', function () {
    return view('auth.login');
})->name('login');


#public routes 

#public ulr for redirecting
Route::get('/register',function(){

    return view('auth.register');

})->name('register');


#set aside for future purposes/ features loan and investment
// Route::get('/Dashboard-Investors',function(){
//     return view('admin.investors.investors');

// });
// Route::get('/Dashboard-Investor-Details',function(){
//     return view('admin.investors.viewInvestor');

// });