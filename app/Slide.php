<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slide extends Model
{
    use SoftDeletes;
    protected $table = 'slide';
    protected $fillable = ['user_email', 'img_path', 'title','is_approved' , 'description'];
    protected $dates = ['deleted_at'];
}
