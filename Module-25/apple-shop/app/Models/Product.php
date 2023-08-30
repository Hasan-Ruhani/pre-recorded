<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    public function brand(): BelongsTo{
        return $this->belongsTo(Brnad::class);
    }
    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }
}
