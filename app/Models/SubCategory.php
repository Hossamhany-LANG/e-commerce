<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_categories';
        protected $fillable = [
        'translation_language',
        'translation_of',
        'category_id',
        'name',
        'slug',
        'photo',
        'active',
    ];

    public function scopeActive($query){
        return $query->where('active' , 1);
    }
    public function getActive(){
        return $this->active == 1 ? 'active' : 'inactive';
    }
    
    public function scopeAvailable($query)
    {
        return $query->where('status', 1)->where('quantity', '>', 0);
    }

    public function scopeSelection($query){
        return $query->select('id' ,'category_id', 'name' , 'slug' , 'photo' ,'active');
    }
    public function getPhotoAttribute($val){
        return ($val !== null) ? asset($val) : "" ;
    }
    public function categories(){
        return $this->hasMany(self::class , 'translation_of');
    }
    public function maincategory(){
        return $this->belongsTo(Main_Category::class, 'category_id', 'id' );
    }
    public function products(){
        return $this->hasMany(Product::class , 'subcategory_id', 'id');
    }
}
