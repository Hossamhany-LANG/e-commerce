<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'quantity',
        'status',
        'photo',
        'category_id',
        'subcategory_id',
    ];

    public function getActive(){
        return $this->status == 1 ? 'active' : 'inactive';
    }
    
    public function scopeAvailable($query)
    {
        return $query->where('status', 1)->where('quantity', '>', 0);
    }

    public function scopeActive($query){
        return $query->where('active' , 1);
    }  
    
    public function getPhotoAttribute($val){
        return ($val !== null) ? asset($val) : "" ;
    }  

    public function category(){
        return $this->belongsTo(Main_Category::class , 'category_id', 'id');
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class , 'subcategory_id', 'id');
    }
    public function productreview()
    {
        return $this->hasMany(ProductReview::class);
    }
    public function WishList(){
        return $this->hasMany(WishList::class);
    }
    public function cart(){
        return $this->hasMany(Cart::class);
    }
    public function orderitems(){
        return $this->hasMany(OrderItem::class);
    }
    public function returnorders(){
        return $this->hasMany(ReturnOrder::class);
    }
    public function comparison(){
        return $this->hasMany(Comparison::class);
    }
    public function discount(){
        return $this->hasone(Product_Discount::class);
    }
}
