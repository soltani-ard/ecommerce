<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'attributes';
    protected $guarded = [];

    public function categories(): belongsToMany
    {
        return $this->belongsToMany(Category::class, 'attribute_category');
    }
}
