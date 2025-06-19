<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'detail', 'price', 'quantity', 'image', 'category'];


    // Quan hệ với các mục đơn hàng
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
