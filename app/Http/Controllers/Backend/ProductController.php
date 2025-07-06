<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    
    public function index()
    {
        // if (Auth::user()->role !== 'admin' || !Auth::user()->hasPermissionTo('manage_products','show_products')) {
        //     return redirect('admin/index');
        // }
        $products = Product::withCount('category')
        ->when(\request()->keyword != null,function($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null,function($query){
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('backend.products.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if (Auth::user()->role !== 'admin' || !Auth::user()->hasPermissionTo('create_products')) {
        //     return redirect('admin/index');
        // }
        $main_categories = Product::whereNull('parent_id')->get(['id' , 'name']);
        return view('backend.product_categories.create' , compact('main_categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductCategoryRequest $request)
    {
        // if (Auth::user()->role !== 'admin' || !Auth::user()->hasPermissionTo('create_products')) {
        //     return redirect('admin/index');
        // }
        $input['name'] = $request->name;
        $input['status'] = $request->status;
        $input['parent_id'] = $request->parent_id;

        if($image = $request->file('cover')){
            $file_name = Str::slug($request->name).".".$image->getClientOriginalExtension();
            $path = public_path('/assets/product_categories/' . $file_name);
            $image->move(public_path('/assets/product_categories'), $file_name);
            
            $input['cover'] = $file_name;
        }
        Product::create($input);
        return redirect()->route('admin.product_categories.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // if (Auth::user()->role !== 'admin' || !Auth::user()->hasPermissionTo('display_products')) {
        //     return redirect('admin/index');
        // }
        return view('backend.product_categories.show');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $Product)
    {
        // if (Auth::user()->role !== 'admin' || !Auth::user()->hasPermissionTo('update_products')) {
        //     return redirect('admin/index');
        // }
        $main_categories = Product::whereNull('parent_id')->get(['id' , 'name']);
        return view('backend.product_categories.edit' , compact('main_categories' , 'Product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductCategoryRequest $request, Product $productCategory)
    {
        // if (Auth::user()->role !== 'admin' || !Auth::user()->hasPermissionTo('update_products')) {
        //     return redirect('admin/index');
        // }
        $input['name'] = $request->name;
        $input['slug'] = null;
        $input['status'] = $request->status;
        $input['parent_id'] = $request->parent_id;

        if($image = $request->file('cover')){
            if($productCategory->cover != null && File::exists('assets/product_categories/'. $productCategory->cover)){
                unlink('assets/product_categories/'. $productCategory->cover);
            }
            $file_name = Str::slug($request->name).".".$image->getClientOriginalExtension();
            $path = public_path('/assets/product_categories/' . $file_name);
            $image->move(public_path('/assets/product_categories'), $file_name);
            
            $input['cover'] = $file_name;
        }
        
        $productCategory->update($input);
        return redirect()->route('admin.product_categories.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $Product)
    {
        // if (Auth::user()->role !== 'admin' || !Auth::user()->hasPermissionTo('delete_products')) {
        //     return redirect('admin/index');
        // }
        if(File::exists('assets/product_categories/'. $Product->cover)){
            unlink('assets/product_categories/'. $Product->cover);}

        $Product->delete();
        return redirect()->route('admin.product_categories.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
