<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Api_keys extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'api_key',
        'callback_url'

    ];
}
