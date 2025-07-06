<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use App\Models\Main_Category;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\MainCategoriesRequest;
use App\Models\Vendor;
use Illuminate\Support\Facades\Config;
use App\UploadImagesTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MainCategoriesController extends Controller
{
    use UploadImagesTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $default_lang = Config::get('app.locale');
        $main_categories = Main_Category::where('translation_language' , $default_lang)->get();
        return view('backend.main-categories.index' , compact('main_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {      
        $languages = Language::select('id', 'name', 'abbr', 'direction', 'active')->where('active' , 1)->get();
        return view('backend.main-categories.create' , compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MainCategoriesRequest $request)
    {
        try{
        $main_categories = collect($request->categories);
        $filter = $main_categories->filter(function($value){
            return $value['abbr'] == Config::get('app.locale'); });
        
        $default_category = array_values($filter->all())[0];

        $file_path = "";
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $file_path = $this->uploadimage('maincategories' ,$request->photo);
        } else {
            return redirect()->back()->withErrors(['error' => 'Uploaded file is invalid or missing!']);
        }

        DB::beginTransaction();
        $default_category_id = Main_Category::create([
            'translation_language' => $default_category['abbr'],
            'translation_of' => 0,
            'name' => $default_category['name'],
            'slug' => $default_category['name'],
            'photo' => $file_path,
            'active' => $default_category['active'],
        ])->id;
        $categories = $main_categories->filter(function($value){
            return $value['abbr'] != Config::get('app.locale'); });
        
        if(isset($categories)){
            $categories_arr=[];
            foreach ($categories as $category) {
                $categories_arr[]=[
                    'translation_language' => $category['abbr'],
                    'translation_of' => $default_category_id,
                    'name' => $category['name'],
                    'slug' => $category['name'],
                    'photo' => $file_path,
                ];
            }

            Main_Category::insert($categories_arr);
        }
        DB::commit();
            return redirect()->route('admin.main_categories.index')->with(['success' => 'the category saved successfully']);
        }catch(\Exception $ex){
        DB::rollBack();
            return redirect()->route('admin.main_categories.index')->with(['error' => 'saving category failed ,please try later']);
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
        // getting categories with its translations
        $main_categories = Main_Category::with('categories')->selection()->find($id);
        if(!$main_categories){
            return redirect()->route('admin.main_categories.index')->with(['error' => 'this category is not found']);
        }
        return view('backend.main-categories.edit' , compact('main_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MainCategoriesRequest $request , $id)
    {
        try{
        $main_categories = Main_Category::find($id);
        if(!$main_categories){
            return redirect()->route('admin.main_categories.index')->with(['error' => 'this category is not found']);
        }
        $category = array_values($request->categories)[0];
        $file_path = "";
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $file_path = $this->uploadimage('maincategories' ,$request->photo);
        } 
        // else {
        //     return redirect()->back()->withErrors(['error' => 'Uploaded file is invalid or missing!']);
        // }
        Main_Category::where('id' ,$id)->update([
            'name' =>$category['name'],
            'active' =>$category['active'],
            'photo' => $file_path,
        ]);
            return redirect()->route('admin.main_categories.index')->with(['success' => 'the category updated successfully']);
        }catch(\Exception $ex){
            return redirect()->route('admin.main_categories.index')->with(['error' => 'editing category failed ,please try later']);
        }    
    }

    // public function update_translation(MainCategoriesRequest $request , $id){

    // }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $main_categories = Main_Category::find($id);
            if(!$main_categories){
                return redirect()->route('admin.main_categories.index')->with(['error' => 'this category is not found']);
            }
            
            $vendors = $main_categories->vendors();
            if(isset($vendors) && $vendors->count() > 0){
                return redirect()->route('admin.main_categories.index')->with(['error' => 'this category can not be deleted']);
            }else{
            $photo = Str::after($main_categories->photo, 'assets/'); // assets نجيب اسم الصوره من بعد كلمه  
            $photoPath = public_path('assets/' . $photo);// عشان نجيب مسار الصوره كامل

            if (file_exists($photoPath)) { 
                unlink($photoPath);
            }
            
            $main_categories->categories()->delete();//اللي هنحذفهاcategoryلحذف الترجمات المتعلقه بال  
            $main_categories->delete();
            return redirect()->route('admin.main_categories.index')->with(['success' => 'the category deleted successfully']);
            }
            
        }catch(\Exception $ex){
            return redirect()->route('admin.main_categories.index')->with(['error' => 'deleting category failed ,please try later']);
        }
    }
    
    public function changestatus($id){
        try{
            $main_categories = Main_Category::find($id);
            if(!$main_categories){
                return redirect()->route('admin.main_categories.index')->with(['error' => 'this category is not found']);
            }
            $status = $main_categories->active == 0 ? 1 : 0 ;
            $main_categories->update(['active' => $status]);
                return redirect()->route('admin.main_categories.index')->with(['success' => 'the status changed successfully']);
        }catch(\Exception $ex){
            return redirect()->route('admin.main_categories.index')->with(['error' => 'deleting category failed ,please try later']);
        }
    }
}
