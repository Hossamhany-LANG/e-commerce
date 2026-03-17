<?php

namespace App\Models;
use App\HasUserOrIpTrait;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasUserOrIpTrait;
    
    protected $guarded = [];
}
