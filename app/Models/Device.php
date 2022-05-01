<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Device extends Model
{
    use \Laravel\Sanctum\HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'uid',
        'appId',
        'os',
        'language',
        'status',
        'expire_date',
        'purchase_date',
        'receipt'
    ];
}
