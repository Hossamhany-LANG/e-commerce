<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        return view('frontend.index');
    }
    public function blank(){
        return view('frontend.blank');
    }
    public function checkout(){
        return view('frontend.checkout');
    }
    public function product(){
        return view('frontend.product');
    }
    public function store(){
        return view('frontend.store');
    }
}
