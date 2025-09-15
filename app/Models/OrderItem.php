<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'kuantitas',   // ganti dari quantity ke kuantitas
        'size',
        'subtotal',
    ];


    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    // Add this method to check if item can be reviewed
    public function canBeReviewed()
    {
        return $this->order->status === 'delivered' && !$this->review;
    }
}
