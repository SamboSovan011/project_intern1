<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'description', 'image', 'stock', 'email', 'SKU', 'price', 'categories_id', 'is_approved'
    ];

    protected $dates = ['deleted_at'];

    public function category() {
        return $this->belongsTo(Categories::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class, 'product_id', 'id');
    }
}
