<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'categories';
    protected $guarded = [];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): hasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'attribute_category');
    }
    public function getIsActiveAttribute($isActive): string
    {
        return $isActive ? 'فعال' : 'غیر فعال';
    }
//    public function getParentIDAttribute($parentID): string
//    {
//        if ($parentID == 0) return 'دسته اصلی';
//        else {
//            $parent = Category::find($parentID);
//            return $parent->name;
//        }
//    }

}
