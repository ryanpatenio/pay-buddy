<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class logs extends Model
{
    use HasFactory;
    protected $fillable = [
        'api_key_id',
        'request_data',
        'response_data',
        'status'

    ];
}
