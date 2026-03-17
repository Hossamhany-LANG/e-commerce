<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];

    public function contactMessage() {
        return $this->belongsTo(ContactUs::class, 'related_id', 'id');
    }

    public function order() {
        return $this->belongsTo(Order::class, 'related_id', 'id');
    }
}
