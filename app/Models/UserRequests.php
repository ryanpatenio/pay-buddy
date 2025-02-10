<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequests extends Model
{
    use HasFactory;
    protected $table = 'user_requests';

    protected $fillable = [
        'user_id',
        'message',
        'status'
    ];
}
