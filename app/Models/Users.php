<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Users extends Authenticatable // HARUS User, bukan Users
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',        // PENTING: pastikan 'name' ada di fillable
        'email',
        'password',
        'phone',
        'birth_date',
        'gender',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date' => 'date',
        'is_active' => 'boolean',
        'password' => 'hashed', // Laravel 10+ otomatis hash
    ];

    protected $attributes = [
        'role' => 'customer',
        'is_active' => true,
    ];

    // Sisanya sama seperti sebelumnya...
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    public function isActive()
    {
        return $this->is_active === true;
    }

    public function getFullNameAttribute()
    {
        return $this->name;
    }

    public function getAvatarUrlAttribute()
    {
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeWithRole($query, $role)
    {
        return $query->where('role', $role);
    }

    public function getFormattedBirthDateAttribute()
    {
        return $this->birth_date ? $this->birth_date->format('d M Y') : null;
    }

    public function getGenderLabelAttribute()
    {
        return match ($this->gender) {
            'male' => 'Laki-laki',
            'female' => 'Perempuan',
            default => 'Tidak diset'
        };
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function deliveredOrders()
    {
        return $this->hasMany(Order::class)->where('status', 'delivered');
    }
}
