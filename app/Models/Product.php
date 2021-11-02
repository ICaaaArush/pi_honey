<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categoryShakaLaka()
    {
        return $this->belongsToMany(Category::class);
    }

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class);
    }
}
