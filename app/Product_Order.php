<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Order extends Model
{
    protected $table = 'product_orders';
    protected $fillable = ['product_id', 'user_id', 'qty', 'subtotal', 'total'];

    public function products(){
        return $this->hasMany(Products::class, 'product_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
