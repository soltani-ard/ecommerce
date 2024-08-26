<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariation extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'product_variations';
    protected $guarded = [];



    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
