<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'subtotal',          // Diperlukan - dari database
        'tax',               // Kemungkinan ada
        'total',             // Kemungkinan ada
        'total_amount',      // Kolom existing
        'shipping_cost',
        'grand_total',
        'payment_method',
        'payment_status',
        'shipping_name',
        'shipping_phone',
        'shipping_email',
        'shipping_address',
        'shipping_city',
        'shipping_province',
        'shipping_postal_code',
        'billing_name',
        'billing_phone',
        'billing_email', 
        'billing_address',
        'billing_city',
        'billing_province',
        'billing_postal_code',
        'notes',
        'order_date',
        'shipped_date',
        'delivered_date',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'shipped_date' => 'datetime',
        'delivered_date' => 'datetime',
    ];

    // TAMBAHKAN METHOD INI
    public static function generateOrderNumber()
    {
        $prefix = 'ORD';
        $date = now()->format('Ymd');
        
        // Cari order terakhir hari ini
        $lastOrder = self::where('order_number', 'like', $prefix . $date . '%')
                        ->orderBy('order_number', 'desc')
                        ->first();
        
        if ($lastOrder) {
            // Ambil 4 digit terakhir dan tambah 1
            $lastNumber = intval(substr($lastOrder->order_number, -4));
            $newNumber = $lastNumber + 1;
        } else {
            // Jika belum ada order hari ini, mulai dari 1
            $newNumber = 1;
        }
        
        // Format: ORD20250908001, ORD20250908002, dst.
        return $prefix . $date . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Tambahkan relasi items juga (yang dipanggil di controller)
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Accessors
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu Pembayaran',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'delivered' => 'Diterima',
            'cancelled' => 'Dibatalkan',
        ];

        return $labels[$this->status] ?? 'Unknown';
    }

    public function getPaymentStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Sudah Dibayar',
            'failed' => 'Pembayaran Gagal',
        ];

        return $labels[$this->payment_status] ?? 'Unknown';
    }

    public function getPaymentMethodLabelAttribute()
    {
        $labels = [
            'bank_transfer' => 'Transfer Bank',
            'credit_card' => 'Kartu Kredit',   // Tambahkan ini
            'ewallet' => 'E-Wallet',
            'cod' => 'Cash on Delivery (COD)',
        ];

        return $labels[$this->payment_method] ?? 'Unknown';
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }
}