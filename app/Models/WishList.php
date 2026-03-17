<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\HasUserOrIpTrait;

class WishList extends Model
{
    use HasUserOrIpTrait;
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}