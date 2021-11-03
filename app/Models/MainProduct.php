<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainProduct extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);   
    }

    public function subcategory()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function supplier()
    {
        return $this->belongsTo(SupplierDetail::class);
    }
}
