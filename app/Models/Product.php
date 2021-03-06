<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);   
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);   
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
