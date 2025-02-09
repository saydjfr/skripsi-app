<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nomor_pesanan',
        'grand_total',
        'payment_methode',
        'payment_status',
        'status',
        'currency',
        'notes',
        'nama_customer',
        'telpon',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(Order_item::class);
    }
}
