<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
    use SoftDeletes;
    protected $table = 'category';
    protected $fillable = ['user_email', 'img_path', 'title', 'description', 'is_approved'];
    protected $dates = ['deleted_at'];

    public function products(){
        return $this->hasMany(Products::class);
    }
}
