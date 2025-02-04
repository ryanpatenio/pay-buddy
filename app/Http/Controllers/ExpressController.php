<?php

namespace App\Http\Controllers;

use App\Services\WalletService;
use Illuminate\Http\Request;

class ExpressController extends Controller
{
    private $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    public function xpress_index(){

        $walletCurrencies = $this->walletService->userWalletCurrencies(); #sender Wallet Currencies
        $transactionFee = $this->walletService->getFee('send_money');#default PHP
        

        return view('users.express-send',compact('walletCurrencies','transactionFee'));
    }
}
