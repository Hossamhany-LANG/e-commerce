<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use Notifiable;
    
    protected $fillable = [
        'name',
        'phone',
        'email',
        'active',
        'logo',
        'category_id',
        'password',
    ];

    protected $hidden =['category_id'];

    public function scopeActive($query){
        return $query->where('active' , 1);
    }
    public function getActive(){
        return $this->active == 1 ? 'active' : 'inactive';
    }
    public function getLogoAttribute($val){
        return ($val !== null) ? asset($val) : "" ;
    }
    public function scopeSelection($query){
        return $query->select('id' , 'name' , 'phone' ,'password','email', 'category_id' , 'logo' ,'active');
    }
    public function category(){
        return $this->belongsTo(Main_Category::class, 'category_id', 'id' );
    }
}
