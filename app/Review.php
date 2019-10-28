<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = ['product_id', 'user_id', 'rating', 'comment'];

    public function products(){
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
