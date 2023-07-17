<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['firstName', 'lasttName', 'email', 'mobile', 'password', 'otp'];
    protected $attributes = [
        'otp' => '0'
    ];
}
