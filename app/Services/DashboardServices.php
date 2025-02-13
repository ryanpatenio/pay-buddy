<?php

namespace App\Services;

use App\Models\currency;
use App\Models\User;
use App\Models\UserRequests;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardServices{

    public function usersCount($date = null){
        switch ($date) {
            case 'now':
                return DB::table('users')
                    ->whereDate('created_at', Carbon::today())
                    ->count();

            case 'month':
                return DB::table('users')
                    ->whereMonth('created_at', Carbon::now()->month) // Filter by current month
                    ->whereYear('created_at', Carbon::now()->year) // Ensure it's the current year
                    ->count();

            default:
                return DB::table('users')->count();
        }
    }

    public function requestCount($date = null){

        switch ($date) {
            case 'now':
                return UserRequests::where('status','pending')
                ->whereDate('created_at',Carbon::today())
                ->count();
            case 'month':
                return UserRequests::whereMonth('created_at', Carbon::now()->month) // Filter by current month
                ->whereYear('created_at', Carbon::now()->year) // Ensure it's the current year
                ->count();

            default:
            return UserRequests::count();
        }
        
    }


    public function earnings($currency = null){
        $default = 'PHP';
        $currency = $currency ?? $default; // Use the provided currency or fallback to the default

        // Fetch today's earnings
        $todayEarnings = DB::table('earnings as e')
            ->join('transactions as t', 'e.transaction_id', '=', 't.id')
            ->join('currencies as c', 't.currency_id', '=', 'c.id')
            ->where('c.code', $currency)
            ->whereDate('e.created_at', Carbon::today())
            ->selectRaw('c.code, c.symbol, coalesce(sum(e.amount), 0) as total')
            ->groupBy('c.code', 'c.symbol')
            ->first();

        // Fetch this month's earnings
        $monthlyEarnings = DB::table('earnings as e')
            ->join('transactions as t', 'e.transaction_id', '=', 't.id')
            ->join('currencies as c', 't.currency_id', '=', 'c.id')
            ->where('c.code', $currency)
            ->whereMonth('e.created_at', Carbon::now()->month)
            ->whereYear('e.created_at', Carbon::now()->year)
            ->selectRaw('c.code, c.symbol, coalesce(sum(e.amount), 0) as total')
            ->groupBy('c.code', 'c.symbol')
            ->first();

        #total
        $today =  DB::table('earnings as e')
            ->join('transactions as t', 'e.transaction_id', '=', 't.id')
            ->join('currencies as c', 't.currency_id', '=', 'c.id')
            ->where('c.code', $currency)
            ->selectRaw('c.code, c.symbol, coalesce(sum(e.amount), 0) as total')
            ->groupBy('c.code', 'c.symbol')
            ->first();

        // Return both today's and monthly earnings
        return [
            'total'=>$today,
            'today' => $todayEarnings,
            'monthly' => $monthlyEarnings,
        ];
    }


    public function showAllCurrencies(){       
        return currency::all();
    }
}