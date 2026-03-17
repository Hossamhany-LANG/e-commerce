<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\HasUserOrIpTrait;

class Comparison extends Model
{
    use HasUserOrIpTrait;

    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class,'product_id' , 'id');
    }
}
