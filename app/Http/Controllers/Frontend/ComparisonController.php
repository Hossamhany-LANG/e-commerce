<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comparison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComparisonController extends Controller
{
    public function addToCompare(Request $request, $id) {
        $exists = Comparison::forCurrentUser()->where('product_id', $id)->exists();

        if ($exists) {
            return response()->json(['message' => 'The product is already on the comparison list.'], 409);
        }

        $count = Comparison::forCurrentUser()->count();
        if ($count >= 4) {
            return response()->json(['message' => 'You can compare a maximum of 4 products'], 400);
        }

        Comparison::create([
            'user_id' => Auth::id(),
            'user_ip' => Auth::id()? null : $request->ip(),
            'product_id' => $id
        ]);

        return response()->json(['message' => 'The product has been added for comparison.'], 200);
    }

    public function index() {
        $comparisons = Comparison::with('product')->forCurrentUser()->get();

        return view('frontend.compare', compact('comparisons'));
    }

    public function remove($id) {
        
        $deleted = Comparison::forCurrentUser()->find($id);

        if ($deleted) {
            $deleted->delete();
            return redirect()->route('compare.index')->with('success', 'Product removed successfully');
        }
        return redirect()->route('compare.index')->with('error', 'Product not found');
    }
}
