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

    public function requestCount(){

        return $this->dashboardService->requestCount('pending');
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

    public function getEarningsReport(Request $request){

        $currency = $request->query('currency', 'PHP'); // Default to PHP

        $earnings = DB::table('earnings')
            ->join('transactions', 'earnings.transaction_id', '=', 'transactions.id')
            ->join('currencies', 'transactions.currency_id', '=', 'currencies.id')
            ->selectRaw("
                DATE_FORMAT(earnings.created_at, '%m') as month,
                SUM(earnings.amount) as total_earnings
            ")
            ->where('currencies.code', $currency) // Filter by selected currency
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        // Initialize array for all 12 months with 0 earnings
        $incomeData = array_fill(1, 12, 0);

        foreach ($earnings as $earning) {
            $incomeData[intval($earning->month)] = $earning->total_earnings;
        }

        return response()->json([
            'income' => array_values($incomeData)
        ]);
    }
}