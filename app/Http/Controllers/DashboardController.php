<?php

namespace App\Http\Controllers;

use App\Models\Fees;
use App\Models\Transactions;
use App\Services\DashboardServices;
use App\Services\TransactionServices;
use App\Services\WalletService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private $walletService;
    private $transactionService;
    private $dashboardService;

    public function __construct(WalletService $walletService, TransactionServices $transactionServices,DashboardServices $dashboardServices)
    {
        $this->walletService = $walletService;
        $this->transactionService = $transactionServices;
        $this->dashboardService = $dashboardServices;
    }
 
    public function index_user(Request $request) {
        // Get the user's selected currency from the session or request
        $selectedCurrency = $request->input('currency') ?? 'PHP'; // Default to PHP if null
       
        
        $walletBalance = $this->getUserWalletBalance($selectedCurrency);
       
        $walletCurrencies = $this->walletService->userWalletCurrencies(); #sender Wallet Currencies
        $transactionFee = $this->walletService->getFee('send_money',$selectedCurrency);

        $recentTransactions = $this->transactionService->showUserTransactions('recent'); #return all Transaction this DaY!
    
        if ($request->ajax()) {
            return response()->json([
                'walletBalance' => $walletBalance,
                'fee'=> number_format($transactionFee,2)
            ]);
        }

        return view('users.dashboard', compact('walletBalance', 'selectedCurrency','walletCurrencies','recentTransactions'));
    }

    public function index_admin(Request $request){
        $selectedCurrency = $request->input('currency');

        #transactions
        $Transactions = $this->transactionService->showTransactions('recent');

        #userCount
        $userCount = $this->dashboardService->usersCount();
        $userCountThisDay = $this->dashboardService->usersCount('now');
        $userCountThisMonth = $this->dashboardService->usersCount('month');

        #Requests
        $totalRequest = $this->dashboardService->requestCount();
        $requestThisDay = $this->dashboardService->requestCount('now');
        $requestThisMonth = $this->dashboardService->requestCount('month');

        $earnings = $this->dashboardService->earnings($selectedCurrency);
        #currencies
        $currencies = $this->dashboardService->showAllCurrencies();

        if ($request->ajax()) {
            return response()->json([
                'total_earnings' => $earnings,              
            ]);
        }

        return view('admin.dashboard',compact(
            'Transactions',

            'userCount',
            'userCountThisDay',
            'userCountThisMonth',

            'totalRequest',
            'requestThisDay',
            'requestThisMonth',

            'earnings',
            'currencies'
        ));
    }

    public function getUserWalletBalance($currency = null) {
        $currency = $currency ?? 'PHP'; // Ensure default is 'PHP' even if null is passed
    
        return DB::table('wallets')
            ->join('currencies', 'wallets.currency_id', '=', 'currencies.id') // Join with the currencies table
            ->where('wallets.user_id', Auth::id()) // Filter by user
            ->where('currencies.code', $currency) // Filter by selected currency
            ->select('wallets.balance', 'currencies.symbol')
            ->first(); // Get the balance directly
    }
    
    public function getEarningsByMonth(){
        
        $earningsByMonth = DB::table('earnings')
            ->selectRaw("DATE_FORMAT(earned_at, '%Y-%m') as month, SUM(amount) as total_earnings")
            ->groupBy('month')
            ->orderByDesc('month')
            ->get();
    }

    public function test(){
        $sendMoneyFee = fees::where('transaction_type', 'send_money')->value('amount'); 
        $externalApiFee = fees::where('transaction_type', 'external_api')->value('amount');


        $transactionType = 'external_api'; // or 'send_money'
        $fee = Fees::where('transaction_type', $transactionType)->value('amount');

        $amount = 100;
        $userId = 1;

        Transactions::create([
            'user_id' => $userId,
            'amount' => $amount,
            'fee' => $fee, // Apply the correct fee
            'transaction_type' => $transactionType,
        ]);
    }


// public function getBalanceData()
    // {
    //     // Example data - Replace this with actual balance fetching logic
    //     $balances = [
    //         "Jan" => 40000, "Feb" => 1000, "Mar" => 1000, "Apr" => 2500,
    //         "May" => 3000, "Jun" => 1500, "Jul" => 4000, "Aug" => 5000,
    //         "Sep" => 8000, "Oct" => 6000, "Nov" => 5500, "Dec" => 6500
    //     ];

    //     // Simulating today's balance & previous day's balance
    //     $today = Carbon::today()->format('M');
    //     $yesterday = Carbon::yesterday()->format('M');

    //     $todayBalance = $balances[$today] ?? 0;
    //     $yesterdayBalance = $balances[$yesterday] ?? 0;

    //     return response()->json([
    //         'labels' => array_keys($balances),
    //         'balances' => array_values($balances),
    //         'today' => $todayBalance,
    //         'yesterday' => $yesterdayBalance
    //     ]);
    // }
}
