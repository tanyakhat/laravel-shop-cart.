<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    protected $fillable = [
        'order_id',   // добавляем поле id
        'product_id', // другие поля модели OrderItem
        'quantity',
        'price',
    ];

}
