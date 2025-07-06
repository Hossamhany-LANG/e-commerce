<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images[]= ['file_name' => '01.png' , 'file_type' => 'image/png' , 'file_size' => rand(100 , 200) , 'file_status' =>true , 'file_sort' => 0];
        $images[]= ['file_name' => '02.png' , 'file_type' => 'image/png' , 'file_size' => rand(100 , 200) , 'file_status' =>true , 'file_sort' => 0];
        $images[]= ['file_name' => '03.png' , 'file_type' => 'image/png' , 'file_size' => rand(100 , 200) , 'file_status' =>true , 'file_sort' => 0];
        $images[]= ['file_name' => '04.png' , 'file_type' => 'image/png' , 'file_size' => rand(100 , 200) , 'file_status' =>true , 'file_sort' => 0];
        $images[]= ['file_name' => '05.png' , 'file_type' => 'image/png' , 'file_size' => rand(100 , 200) , 'file_status' =>true , 'file_sort' => 0];
        $images[]= ['file_name' => '06.png' , 'file_type' => 'image/png' , 'file_size' => rand(100 , 200) , 'file_status' =>true , 'file_sort' => 0];
        $images[]= ['file_name' => '07.png' , 'file_type' => 'image/png' , 'file_size' => rand(100 , 200) , 'file_status' =>true , 'file_sort' => 0];
        $images[]= ['file_name' => '08.png' , 'file_type' => 'image/png' , 'file_size' => rand(100 , 200) , 'file_status' =>true , 'file_sort' => 0];

        Product::all()->each(function($product) use ($images){
            $product->media()->createMany(Arr::random($images, rand(2 ,3)));
        });
    }
}
