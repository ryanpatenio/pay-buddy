<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'currency_id',
        'balance',
        'account_number'
        
    ];

    // Method to generate a unique account number
    public static function generateAccountNumber($userId, $currencyId)
    {
        $currencyPrefix = Currency::find($currencyId)->code; // Get the currency code
        $sequentialId = self::where('currency_id', $currencyId)->max('account_number');
        $sequentialId = $sequentialId ? intval(substr($sequentialId, 3)) + 1 : 1;

        return $currencyPrefix . str_pad($sequentialId, 8, '0', STR_PAD_LEFT);
    }

     // Define relationship with User
     public function user()
     {
         return $this->belongsTo(User::class);
     }

     // A wallet belongs to a currency
        public function currency()
        {
            return $this->belongsTo(Currency::class);
        }

      
}
