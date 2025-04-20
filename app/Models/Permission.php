<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];

    public function parent(){
        return $this->hasOne(Permission::class , 'id' , 'parent');
    }
    public function children(){
        return $this->hasMany(Permission::class , 'parent' , 'id');
    }
    public function tree($level = 1){
        return static::with(implode('.' , array_fill(0 , $level , 'children')))
        ->whereParent(0)
        ->whereAppear(1)
        ->whereSidebarLink(1)
        ->orderBy('ordering' , 'asc')
        ->get();
    }
}
