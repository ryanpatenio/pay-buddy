<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'receiver_wallet_id',
        'api_key_id',
        'transaction_id',
        'client_ref_id',
        'type',
        'amount',
        'status',
        'description',
        'fee',
        'currency_id'
    ];

    
}
