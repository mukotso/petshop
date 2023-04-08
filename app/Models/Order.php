<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'uuid',
        'user_uuid',
        'order_status_uuid',
        'payment_uuid',
        'products',
        'address',
        'delivery_fee',
        'amount',
        'shipped_at'
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y h:i a',
        'updated_at' => 'datetime:d/m/Y h:i a',
        'products' => 'array',
        'address' => 'array',
    ];

    public function scopeShipped($query)
    {
        return $query->whereNotNull('shipped_at');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'uuid', 'user_uuid');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'uuid', 'payment_uuid');
    }

    public function orderStatus()
    {
        return $this->hasOne(OrderStatus::class, 'uuid', 'order_status_uuid');
    }
}
