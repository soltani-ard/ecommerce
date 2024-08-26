<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, Sluggable, SoftDeletes;
    protected $table = 'products';
    protected $guarded = [];

    public function sluggable(): array
    {
        // use 'name' column for creating slug
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }

    public function getIsActiveAttribute($isActive): string
    {
        return $isActive ? 'فعال' : 'غیر فعال';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }

    public  function attributes(): hasMany
    {
       return $this->hasMany(ProductAttribute::class);
    }

    public function variations(): hasMany
    {
       return $this->hasMany(ProductVariation::class);
    }

    public  function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
}
