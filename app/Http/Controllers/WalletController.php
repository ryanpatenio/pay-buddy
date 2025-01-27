<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function index(){

    }

    public function myBalance(){
       try {
            $results = User::join('wallets', 'users.id', '=', 'wallets.user_id')
            ->where('wallets.currency', 'PHP')
            ->where('users.id',Auth::id())
            ->select('users.name', 'wallets.balance')
            ->get();

            if(!$results){
               return json_message(EXIT_BE_ERROR,'failed to fetch balance');
            }

            return json_message(EXIT_SUCCESS,'ok',$results);
       } catch (\Throwable $th) {
            return handleException($th,'failed to fetch balance',$th->getMessage());
       }

    }
}
