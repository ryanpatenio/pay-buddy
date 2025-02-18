<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'city',
        'province',
        'brgy',
        'zip_code',
        'country',
        'phone_number',
        'overview',
        'img_url'
    ];
}
