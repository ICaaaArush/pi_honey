<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class); 
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function delivery()
    {
        return $this->belongsTo(DeliveryCompany::class, 'delivery_company_id', 'id'); 
    }
}
