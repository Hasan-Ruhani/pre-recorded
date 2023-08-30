<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductReview extends Model
{
    public function profiel(): BelongsTo{
        return $this->belongsTo(CustomerProfile::class);
    }
    protected $fillable = ['description', 'rating', 'customer_id', 'product_id'];
}
