<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name', 'description', 'image', 'stock', 'email', 'SKU', 'price', 'categories_id'
    ];

    protected $dates = ['deleted_at'];

    public function category() {
        return $this->belongsTo(Categories::class);
    }
}
