<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Transactions extends Controller
{
  
    public function index(){
       
        return view('transaction.index');
    }
}
