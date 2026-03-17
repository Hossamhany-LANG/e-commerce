<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\HasUserOrIpTrait;

class Order extends Model
{
    use HasUserOrIpTrait;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orderitems(){
        return $this->hasMany(orderitem::class);
    }
    public function returnorders(){
        return $this->hasMany(ReturnOrder::class);
    }
}