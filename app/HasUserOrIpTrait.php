<?php

namespace App;

use Illuminate\Support\Facades\Auth;

trait HasUserOrIpTrait
{
    public function scopeForCurrentUser($query){
        $user_id = Auth::id();
        $user_ip = request()->ip();

        return $query->where(function ($q) use ($user_id, $user_ip) {
            if ($user_id) {
                $q->where('user_id', $user_id);
            } else {
                $q->where('user_ip', $user_ip);
            }
        });
    }
}