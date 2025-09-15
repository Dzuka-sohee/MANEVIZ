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
        'subtotal',
        'tax',
        'total',
        'total_amount',
        'shipping_cost',
        'grand_total',
        'payment_method',
        'payment_status',
        'transaction_id',      // Midtrans transaction ID
        'snap_token',         // Midtrans snap token
        'payment_type',       // Payment type (midtrans, cod, etc)
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

    public static function generateOrderNumber()
    {
        $prefix = 'ORD';
        $date = now()->format('Ymd');

        // Cari order terakhir hari ini
        $lastOrder = self::where('order_number', 'like', $prefix . $date . '%')
            ->orderBy('order_number', 'desc')
            ->first();

        if ($lastOrder) {
            // Ambil 3 digit terakhir dan tambah 1
            $lastNumber = intval(substr($lastOrder->order_number, -3));
            $newNumber = $lastNumber + 1;
        } else {
            // Jika belum ada order hari ini, mulai dari 1
            $newNumber = 1;
        }

        // Format: ORD20250911001, ORD20250911002, dst.
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

    // Alias untuk items (compatibility)
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
            'credit_card' => 'Kartu Kredit',
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

    // Helper methods for Midtrans
    public function isMidtransPayment()
    {
        return in_array($this->payment_method, ['bank_transfer', 'credit_card', 'ewallet']) && $this->payment_type === 'midtrans';
    }

    public function needsPayment()
    {
        return $this->payment_status === 'pending' && $this->payment_method !== 'cod';
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Check if order has any unreviewed items
    public function hasUnreviewedItems()
    {
        return $this->status === 'delivered' &&
            $this->orderItems()->whereDoesntHave('review')->exists();
    }
}
