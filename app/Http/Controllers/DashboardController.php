<?php

namespace App\Http\Controllers;

use App\Models\Fees;
use App\Models\Transactions;
use App\Services\WalletService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }
 
    public function index(Request $request) {
        // Get the user's selected currency from the session or request
        $selectedCurrency = $request->input('currency', session('selected_currency', 'PHP'));
    
        // Store the selected currency in session
        session(['selected_currency' => $selectedCurrency]);
    
        // Get wallet balance based on selected currency
        $walletBalance = $this->getUserWalletBalance($selectedCurrency);
        $walletCurrencies = $this->walletService->userWalletCurrencies();
    
        if ($request->ajax()) {
            return response()->json(['walletBalance' => number_format($walletBalance, 2)]);
        }

        return view('users.dashboard', compact('walletBalance', 'selectedCurrency','walletCurrencies'));
    }

    public function getUserWalletBalance($currency = 'PHP') {

       return DB::table('wallets')
            ->join('currencies', 'wallets.currency_id', '=', 'currencies.id') // Join with the currencies table
            ->where('wallets.user_id', Auth::id()) // Filter by user
            ->where('currencies.code', $currency) // Filter by selected currency
            ->value('wallets.balance'); // Get the balance directly

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
