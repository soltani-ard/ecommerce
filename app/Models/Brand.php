<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, Sluggable, SoftDeletes;
    protected $table = 'brands';
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
}
