<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $computerdevices = ProductCategory::create(['name' => 'computerdevices' , 'cover' => 'computer.jpg' , 'status' => true , 'parent_id' =>null]);
        ProductCategory::create(['name' => 'Laptops' , 'cover' => 'Laptops.jpg' , 'status' => true , 'parent_id' =>$computerdevices->id]);
        ProductCategory::create(['name' => 'Computers' , 'cover' => 'computers.jpg' , 'status' => true , 'parent_id' =>$computerdevices->id]);
        ProductCategory::create(['name' => 'Tablets' , 'cover' => 'tablets.jpg' , 'status' => true , 'parent_id' =>$computerdevices->id]);

        $smartphones = ProductCategory::create(['name' => 'SmartPhones' , 'cover' => 'smartphones.jpg' , 'status' => true]);
        ProductCategory::create(['name' => 'Android' , 'cover' => 'android.jpg' , 'status' => true , 'parent_id' =>$smartphones->id]);
        ProductCategory::create(['name' => 'Ios' , 'cover' => 'ios.jpg' , 'status' => true , 'parent_id' =>$smartphones->id]);
        ProductCategory::create(['name' => 'Windows' , 'cover' => 'windows.jpg' , 'status' => true , 'parent_id' =>$smartphones->id]);

        $Cameras = ProductCategory::create(['name' => 'Cameras' , 'cover' => 'cameras.jpg' , 'status' => true]);
        ProductCategory::create(['name' => 'Digital Cameras' , 'cover' => 'digitalcamera.jpg' , 'status' => true , 'parent_id' =>$Cameras->id]);
        ProductCategory::create(['name' => 'Video Cameras' , 'cover' => 'videocamera.jpg' , 'status' => true , 'parent_id' =>$Cameras->id]);

        $Home_Electronics = ProductCategory::create(['name' => 'HomeElectronics' , 'cover' => 'home_electronics.jpg' , 'status' => true]);
        ProductCategory::create(['name' => 'TVs' , 'cover' => 'tv.jpg' , 'status' => true , 'parent_id' =>$Home_Electronics->id]);
        ProductCategory::create(['name' => 'Radios' , 'cover' => 'radio.jpg' , 'status' => true , 'parent_id' =>$Home_Electronics->id]);
        ProductCategory::create(['name' => 'Air Conditioners' , 'cover' => 'airconditioner.jpg' , 'status' => true , 'parent_id' =>$Home_Electronics->id]);

        $Smart_Devices = ProductCategory::create(['name' => 'SmartDevices' , 'cover' => 'smartdevice.jpg' , 'status' => true]);
        ProductCategory::create(['name' => 'Smart Watches' , 'cover' => 'smartwatche.jpg' , 'status' => true , 'parent_id' =>$Smart_Devices->id]);
        ProductCategory::create(['name' => 'Fitness Trackers' , 'cover' => 'fitnesstracker.jpg' , 'status' => true , 'parent_id' =>$Smart_Devices->id]);

        $Accessories = ProductCategory::create(['name' => 'Accessories' , 'cover' => 'accessory.jpg' , 'status' => true]);
        ProductCategory::create(['name' => 'Comuter Accessories' , 'cover' => 'comuteraccessory.jpg' , 'status' => true , 'parent_id' =>$Accessories->id]);
        ProductCategory::create(['name' => 'Mobile Accessories' , 'cover' => 'mobileaccessory.jpg' , 'status' => true , 'parent_id' =>$Accessories->id]);
        ProductCategory::create(['name' => 'Camera Accessories' , 'cover' => 'cameraaccessory.jpg' , 'status' => true , 'parent_id' =>$Accessories->id]);
    }
}
