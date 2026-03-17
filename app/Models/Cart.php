<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\HasUserOrIpTrait;

class Cart extends Model
{
    use HasUserOrIpTrait;
    protected $guarded =[];
    
    protected $table = 'carts';

    public function product(){
        return $this->belongsTo(Product::class);
    }
}