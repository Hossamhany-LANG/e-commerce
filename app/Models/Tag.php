<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable; 
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    use Sluggable;
    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function products():MorphToMany{
        return $this->morphToMany(Product::class,'taggable');
    }
}
