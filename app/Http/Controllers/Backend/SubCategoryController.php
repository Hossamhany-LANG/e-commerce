<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Main_Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\SubcategoryRequest;
use App\UploadImagesTrait;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    use UploadImagesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::paginate(10);
        return view('backend.subcategories.index' , compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $main_categories = Main_Category::where('translation_of' , 0)->active()->get();
        return view('backend.subcategories.create' , compact('main_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubcategoryRequest $request)
    {
        try{
            $filepath = '';
            if($request->hasFile('photo') && $request->file('photo')->isValid()){
                $filepath = $this->uploadimage('subcategories' , $request->photo);
            }else {
                return redirect()->route('admin.subcategories.index')->with(['error' => 'Uploaded file is invalid or missing!']);
            }
            
            SubCategory::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => $request->name,
                'photo' => $filepath,
                'active' => $request->active,
            ]);

            return redirect()->route('admin.subcategories.index')->with(['success' => 'the subcategory added successfully']);
        }catch(\Exception $ex){
            return $ex;
            return redirect()->route('admin.subcategories.index')->with(['error' => 'there is a problem, please try later']);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{
            $subcategory = SubCategory::find($id);
            if(!isset($subcategory)){
                return redirect()->route('admin.subcategories.index')->with(['error' => 'this subcategory not found']);
            }
            $main_categories = Main_Category::where('translation_of' , 0)->active()->get();

            return view('backend.subcategories.edit' , compact('subcategory' , 'main_categories'));
        }catch(\Exception $ex){
            return redirect()->route('admin.subcategories.index')->with(['error' => 'there is a problem, please try later']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubcategoryRequest $request, string $id)
    {
        try{
            $subcategory = SubCategory::find($id);
            if(!$subcategory){
                return redirect()->route('admin.subcategories.index')->with(['error' => 'this subcategory not found']);
            }

            $filepath = $subcategory->photo; 
            if ($request->hasFile('photo')) {
                if ($request->file('photo')->isValid()) {
                    $filepath = $this->uploadimage('subcategories', $request->photo);
                } else {
                    return redirect()->route('admin.subcategories.index')->with(['error' => 'Uploaded file is invalid!']);
                }
            }
            
            $subcategory->update([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'slug' => $request->name,
                'photo' => $filepath,
                'active' => $request->active,
            ]);
            return redirect()->route('admin.subcategories.index')->with(['success' => 'the subcategory added successfully']);
        }catch(\Exception $ex){
            return $ex;
            return redirect()->route('admin.subcategories.index')->with(['error' => 'there is a problem, please try later']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $subcategory = SubCategory::find($id);
            
            if(!$subcategory){
                return redirect()->route('admin.subcategories.index')->with(['error' => 'this subcategory is not found']);
            }

            $photo = Str::after($subcategory->photo , 'assets/');
            $photo_path = public_path('assets/' . $photo);
            if(file_exists($photo_path)){
                unlink($photo_path);
            }
            $subcategory->delete();
            return redirect()->route('admin.subcategories.index')->with(['success' => 'the subcategory deleted successfully']);
        }catch(\Exception $ex){
            return redirect()->route('admin.subcategories.index')->with(['error' => 'there is a problem, please try later']);
        }
    }
    public function changestatus($id){
        try{
            $subcategory = SubCategory::find($id);
            if(!$subcategory){
                return redirect()->route('admin.subcategories.index')->with(['error' => 'this subcategory is not found']);
            }
            $status = $subcategory->active == 0 ? 1 : 0 ;
            $subcategory->update(['active' => $status]);
                return redirect()->route('admin.subcategories.index')->with(['success' => 'the status changed successfully']);
        }catch(\Exception $ex){
            return redirect()->route('admin.subcategories.index')->with(['error' => 'changing status failed ,please try later']);
        }
    }
}
