<?php

use App\Http\Controllers\ApiKeysController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CurrenciesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpressController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\Transactions;
use App\Http\Controllers\UserController;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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


#User Registration and Authentication
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
        Route::get('/Notifications-count',[NotificationController::class,'notificationsCount']);
        Route::get('/Notifications-all',[NotificationController::class,'allNotifications']);
        Route::patch('/user-mark-all-read',[NotificationController::class,'markAllRead']);
        Route::get('/user-UI-selected-notif-item/{id}',[NotificationController::class,'getNotification']);
        Route::patch('/user-UI-mark-as-read',[NotificationController::class,'update']);
        
        #Profile
        Route::get('/Profile-Account',[ProfileController::class,'index_user']);
        Route::patch('/Profile-update',[PRofileController::class,'updateBasicInfo']);
        Route::get('/Profile-email',[ProfileController::class,'getEmail']);
        Route::patch('/Profile-update-email',[ProfileController::class,'updateEmail']);
        Route::patch('/Profile-password-update',[ProfileController::class,'updatePassword']);
        Route::post('/Profile-deactivate',[ProfileController::class,'deactivateAccount']);
        Route::post('/Profile-new-wallet',[ProfileController::class,'addNewWallet']);
        Route::get('/user-avatar',[ProfileController::class,'fetchAvatar']);
        Route::post('/Profile-upload-avatar',[ProfileController::class,'uploadAvatar']);

        #Requests
        Route::get('/Profile-Request',[RequestsController::class,'index_user']);
        Route::post('/Profile-new-Request',[RequestsController::class,'newRequest']);

        #Api Keys
        Route::middleware(['is_dev'])->group(function(){
            Route::get('/Api-keys',[ApiKeysController::class,'api_index']);
            Route::get('/Api-keys-gen',[ApiKeysController::class,'generateKey']);
            Route::post('/Api-keys-create',[ApiKeysController::class,'createApiKey']);
            Route::post('/Api-keys-regenerate',[ApiKeysController::class,'regenerateNewApiKey']);
            Route::get('/Api-keys-setup',function(){
                return view('users.api_keys.api_setup');
            });
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
        Route::get('/Bank-receipt/{id}',[BankController::class,'bankReceiptIndex']);
    
        #testing
        Route::get('/balance-data', [DashboardController::class, 'getBalanceData']);
        
        // Route::get('/Profile',function(){
        //     return view('users.profile');
        // });

    });

    #admin
    Route::middleware(['role:admin|super_admin'])->group(function (){
        #Dashboard
        Route::get('/Dashboard-admin',[DashboardController::class,'index_admin'])->name('admin.dashboard');
        Route::get('/earnings-report', [DashboardController::class, 'getEarningsReport']);

       
        
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

        #ADMIN Profile
        Route::get('/Dashboard-Profile-Account',[ProfileController::class,'index_admin']);
        Route::get('/Dashboard-profile-details',[ProfileController::class,'myDetails']);
        Route::get('/Dashboard-profile-email',[ProfileController::class,'myEmail']);
        Route::patch('/Dashboard-user-updateDetails',[ProfileController::class,'updateBasicInfo']);
        Route::patch('/Dashboard-profile-upEmail',[ProfileController::class,'updateEmail']);
        Route::patch('/Dashboard-profile-pass-update',[ProfileController::class,'updateProfilePassword']);
        Route::post('/Dashboard-profile-upload-avatar',[ProfileController::class,'uploadAvatar']);

        #UI
        Route::get('/UI-dashboard-admin-avatar',[ProfileController::class,'fetchAvatar']);
        Route::get('/UI-admin-request',[DashboardController::class,'requestCount']);

        #API keys
        Route::get('/Dashboard-Api-keys',[ApiKeysController::class,'index_admin']);
        Route::post('/Api-Keys-disable',[ApiKeysController::class,'setDisable']);
       
       
        Route::get('/Dashboard-Logs',[LogsController::class,'index_admin']);
        Route::get('/Dashboard-User-logs',[LogsController::class,'userLogs']);
        Route::get('/Dashboard-User-show/{id}',[LogsController::class,'userLogs'])->name('get.user');
        Route::get('/Dashboard-userLogs/{id}',[LogsController::class,'getLogs']);
       
        #Dashboard View User
        Route::get('/Dashboard-viewUser',function(){
            return view('admin.users.viewUser');
        
        });
        Route::get('/fetch-user/{id}',[UserController::class,'fetchUser']);
        Route::post('/User-update-avatar',[UserController::class,'updateAvatar']);
        Route::get('/user-wallets/{id}',[UserController::class,'showAllUserWallets']);
        Route::patch('/update-user-walletBalance',[UserController::class,'updateUserBalance']);
        Route::get('/fetch-available-currenciesById/{id}',[UserController::class,'fetchCurrencies']);
        Route::post('/add-newCurrency-toUserWallet',[UserController::class,'addNewWallet']);

    
        #CURRENCIES
        Route::get('/Currencies',[CurrenciesController::class,'index_admin']);
        Route::post('/Currencies-create',[CurrenciesController::class,'create']);
        Route::get('/Currency-get/{id}',[CurrenciesController::class,'getCurrency']);
        Route::patch('/Currency-update',[CurrenciesController::class,'updateCurrency']);
        Route::post('/Currency-update-img',[CurrenciesController::class,'updateImage']);

        #Bank-Partners
        Route::get('/Bank-Partners',[BankController::class,'index_admin']);
        Route::post('/Bank-create',[BankController::class,'create']);
        Route::get('/Bank-get/{id}',[BankController::class,'getBank']);
        Route::patch('/Bank-update',[BankController::class,'updateBank']);
        Route::patch('/Bank-update-api',[BankController::class,'updateBankApiKey']);
        Route::post('/Bank-update-img',[BankController::class,'updateImage']);
       
        #Fees
        Route::get('/Fees',[FeesController::class,'index_admin']);
        Route::get('/Fee-Currencies',[FeesController::class,'currencies']);
        Route::post('/Fee-create',[FeesController::class,'addFee']);
        Route::get('/Fee-get/{id}',[FeesController::class,'getFee']);
        Route::patch('/Fee-update',[FeesController::class,'updateFee']);

        Route::get('/debug-file-check', function() {
            $filename = 'um94TX3bg9_1744444766.jfif';
            $path = storage_path('app/public/img/avatar/'.$filename);
            
            return response()->json([
                'file_exists' => file_exists($path),
                'full_path' => $path,
                'files_in_folder' => scandir(dirname($path))
            ]);
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