<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
    protected $table = 'reviews';
    protected $fillable = ['product_id', 'user_id', 'rating', 'comment'];
    protected $dates = ['deleted_at'];

    public function products(){
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
