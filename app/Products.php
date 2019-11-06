<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'description', 'image', 'stock', 'email', 'SKU', 'price','avg_rating', 'categories_id', 'is_approved', 'discount', 'startDatePro', 'stopDatePro', 'priceAfterPro'
    ];

    protected $dates = ['deleted_at'];

    public function categories() {
        return $this->belongsTo(Categories::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class, 'product_id', 'id');
    }

    public function product_orders(){
        return $this->hasMany(Product_Order::class, 'id', 'product_id');
    }

}
