<?php

namespace App;

trait UploadImagesTrait
{
    
    public function uploadimage($folder , $image)
    {
        $destinationPath = public_path("assets/{$folder}");
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0775, true);
        }
        $filename =$image->getClientOriginalName(); //لمنع التكرار او استبدال الصور السابقه
        $image->move($destinationPath, $filename);
        

        return "assets/{$folder}/{$filename}";
    }
}


