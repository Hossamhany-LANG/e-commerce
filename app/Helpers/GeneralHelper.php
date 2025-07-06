<?php
namespace App\Helpers;

use App\Models\Language;
use Illuminate\Support\Facades\Config;

class GeneralHelper
{
    public function get_language(){
        return Language::where('active' , 1)->get();
    }
}