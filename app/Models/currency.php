<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class currency extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name', 'symbol'];
     protected $table = 'currencies';

    public function wallets (){
        
        $this->hasMany(Wallets::class);
    }
}
