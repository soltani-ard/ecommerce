<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'banners';
    protected $guarded = [];

    public function getIsActiveAttribute($isActive): string
    {
        return $isActive ? 'فعال' : 'غیر فعال';
    }
}
