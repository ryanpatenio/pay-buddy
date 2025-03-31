<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bankTransactionDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'receiver_name',
        'receiver_account_number',
        'bank_id',
        'sender_balance_before',
        'sender_balance_after',
        'api_response'
        
    ];

     public function bankPartner()
     {
         return $this->belongsTo(BankPartners::class,'bank_id');
     }
}
