<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'shop_id',
        'name',
        'slug',
        'image',
        'description',
        'price',
        'is_raady'
    ];

    protected $casts = [
        'image' => 'array',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function shop(){
        return $this->belongsTo(Shop::class);
    }

    public function items(){
        return $this->hasMany(Order_item::class);
    }
}
