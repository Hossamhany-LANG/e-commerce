<?php

namespace App\Models;

use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Model;

class Main_Category extends Model
{
    protected $table = 'main_categories';

    protected $fillable = [
        'translation_language',
        'translation_of',
        'name',
        'slug',
        'photo',
        'active',
    ];

    protected static function boot(){
        parent::boot();
        Main_Category::observe(MainCategoryObserver::class);
    }
    public function scopeActive($query){
        return $query->where('active' , 1);
    }
    public function getActive(){
        return $this->active == 1 ? 'active' : 'inactive';
    }
    public function scopeSelection($query){
        return $query->select('id' , 'translation_language' , 'translation_of', 'name' , 'slug' , 'photo' ,'active');
    }
    public function getPhotoAttribute($val){
        return ($val !== null) ? asset($val) : "" ;
    }
    public function categories(){
        return $this->hasMany(self::class , 'translation_of');
    }
    public function vendors(){
        return $this->hasMany(Vendor::class, 'category_id', 'id' );
    }
    public function products(){
        return $this->hasMany(Product::class, 'category_id', 'id' );
    }
    public function subcategories(){
        return $this->hasMany(SubCategory::class, 'category_id', 'id' );
    }
    public function orderItems(){
    return $this->hasManyThrough(OrderItem::class, Product::class, 'category_id','product_id','id', 'id'  );
}
}
