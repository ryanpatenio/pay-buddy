<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earnings extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_id','user_id','amount','earned_at'];
}
