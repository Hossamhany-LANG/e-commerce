<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create(['name' => 'computerdevices' , 'status' =>true]);
        Tag::create(['name' => 'SmartPhones' , 'status' =>true]);
        Tag::create(['name' => 'Cameras' , 'status' =>true]);
        Tag::create(['name' => 'HomeElectronics' , 'status' =>true]);
        Tag::create(['name' => 'SmartDevices' , 'status' =>true]);
        Tag::create(['name' => 'Accessories' , 'status' =>true]);
    }
}
