<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
        $query = $request->input('query');
        $results = Product::with('subcategory')->where('name', 'LIKE', "%{$query}%")
        ->orWhere('description', 'LIKE', "%{$query}%") ->get();
        if(!$query){
            return redirect()->back();
        }
        return view('frontend.search.search-results', compact('results', 'query'));
    }
}
