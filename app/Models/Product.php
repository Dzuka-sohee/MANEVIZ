<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImages;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'deskripsi',
        'deskripsi_singkat',
        'harga',
        'harga_jual',
        'sku',
        'stock_kuantitas',
        'berat',
        'dimensi',
        'ukuran',
        'status',
        'is_featured',
        'rating_rata',
        'total_reviews',
        'total_penjualan',
        'meta_data',
    ];

    protected $casts = [
        'dimensi' => 'array',
        'meta_data' => 'array',
        'is_featured' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }
    public function primaryImage()
    {
        return $this->hasOne(ProductImages::class)->where('is_primary', true);
    }

    // 🔹 Scope untuk hanya ambil produk aktif
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
