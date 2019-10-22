<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'category';
    protected $fillable = ['user_email', 'img_path', 'title', 'description', 'is_approved'];
}
