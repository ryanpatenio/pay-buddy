<?php

namespace App\Models;

use Carbon\Carbon;
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

     // Define an accessor to format the created_at field
     public function getCreatedAtAttribute($value)
     {
         return Carbon::parse($value)->format('F j, Y g:i A');
     }
}

