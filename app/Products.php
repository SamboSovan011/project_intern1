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

    public function users(){
        return $this->belongsToMany(User::class)->withPivot(['products_id'])->withTimestamps();
    }

    public function checkout(){
        return $this->belongsTo(Checkout::class, 'products_id', 'id');
    }

}
