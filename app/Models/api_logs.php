<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class api_logs extends Model
{
    use HasFactory;
    protected $table = "api_logs";

    protected $fillable = [
        'api_key_id',
        'request_data',
        'response_data',
        'status'

    ];
}
