<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Product_Discount;
use App\Models\SubCategory;

class ItemsController extends Controller
{
    public function computerdevices(){

        $products = Product::Available()->where('category_id', 1)->withCount('productreview')
        ->withAvg('productreview', 'rating')->get();

        $subcategories = SubCategory::with(['products' => function($query){
            $query->Available()->where('category_id', 1)
            ->latest()->take(1);}])->get();

            return view("frontend.products.computerdevices", compact('products' , 'subcategories'));
    }

    public function smartphones(){
        $products = Product::Available()->where('category_id', 3)->withCount('productreview')
        ->withAvg('productreview', 'rating')->get();

        $subcategories = SubCategory::with(['products' => function($query){
            $query->Available()->where('category_id', 3 )
            ->latest()->take(1);}])->get();

        return view("frontend.products.smartphones", compact('products', 'subcategories'));
    }

    public function cameras(){
        $products = Product::Available()->where('category_id', 5)->withCount('productreview')
        ->withAvg('productreview', 'rating')->get();

        $subcategories = SubCategory::with(['products' => function($query){
            $query->Available()->where('category_id', 5)
            ->latest()->take(1);}])->get();

        return view("frontend.products.cameras", compact('products', 'subcategories'));
    }

    public function homeelectronics(){
        $products = Product::Available()->where('category_id', 7)->withCount('productreview')
        ->withAvg('productreview', 'rating')->get();

        $subcategories = SubCategory::with(['products' => function($query){
            $query->Available()->where('category_id', 7)
            ->latest()->take(1);}])->get();

        return view("frontend.products.homeelectronics", compact('products', 'subcategories'));
    }

    public function accessories(){
        $products = Product::Available()->where('category_id', 11)->withCount('productreview')
        ->withAvg('productreview', 'rating')->get();

        $subcategories = SubCategory::with(['products' => function($query){
            $query->Available()->where('category_id', 11)
            ->latest()->take(1);}])->get();

        return view("frontend.products.accessories", compact('products', 'subcategories'));
    }
}
