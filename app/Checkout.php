<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Products;

class Checkout extends Model
{
    use SoftDeletes;
    protected $table = "products_user";
    protected $fillable = ['id', 'acceptBy', 'products_id', 'user_id', 'fullname', 'qty', 'email1', 'email2', 'phone1', 'phone2', 'address1', 'address2', 'country', 'city_province', 'zip', '_token', 'subtotal', 'total', 'delivery_date'];
    protected $dates = ['deleted_at'];
    public function users(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function products(){
        return $this->hasMany(Products::class, 'id', 'products_id');
    }
}
