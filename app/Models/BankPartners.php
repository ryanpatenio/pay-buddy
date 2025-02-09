<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankPartners extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'url',
        'api_key',
        'img_url'
    ];

    // Optionally, you can encrypt the API key when storing it
    // public function setApiKeyAttribute($value)
    // {
    //     $this->attributes['api_key'] = encrypt($value);
    // }

    // // Optionally, decrypt the API key when retrieving it
    // public function getApiKeyAttribute($value)
    // {
    //     return decrypt($value);
    // }

}
