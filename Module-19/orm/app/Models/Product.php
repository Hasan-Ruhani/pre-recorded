<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 
        'short_des', 
        'price', 
        'discount', 
        'discount_price', 
        'image', 
        'stock', 
        'star', 
        'remark'
    ];
}
