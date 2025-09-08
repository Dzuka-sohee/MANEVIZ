<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'kuantitas',
        'color',
        'size',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Accessor untuk total harga item
    public function getTotalAttribute()
    {
        $price = $this->product->harga_jual ?? $this->product->harga;
        return $price * $this->kuantitas;
    }

    // Scope untuk user tertentu
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Method untuk format harga
    public function getFormattedTotalAttribute()
    {
        return 'IDR ' . number_format($this->total, 0, ',', '.');
    }

    // Method untuk cek apakah item sama (produk, warna, ukuran)
    public static function findSimilarItem($userId, $productId, $color = null, $size = null)
    {
        return self::where('user_id', $userId)
                   ->where('product_id', $productId)
                   ->where('color', $color)
                   ->where('size', $size)
                   ->first();
    }
}