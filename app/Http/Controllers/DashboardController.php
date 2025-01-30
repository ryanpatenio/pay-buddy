<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getBalanceData()
    {
        // Example data - Replace this with actual balance fetching logic
        $balances = [
            "Jan" => 40000, "Feb" => 1000, "Mar" => 1000, "Apr" => 2500,
            "May" => 3000, "Jun" => 1500, "Jul" => 4000, "Aug" => 5000,
            "Sep" => 8000, "Oct" => 6000, "Nov" => 5500, "Dec" => 6500
        ];

        // Simulating today's balance & previous day's balance
        $today = Carbon::today()->format('M');
        $yesterday = Carbon::yesterday()->format('M');

        $todayBalance = $balances[$today] ?? 0;
        $yesterdayBalance = $balances[$yesterday] ?? 0;

        return response()->json([
            'labels' => array_keys($balances),
            'balances' => array_values($balances),
            'today' => $todayBalance,
            'yesterday' => $yesterdayBalance
        ]);
    }
}
