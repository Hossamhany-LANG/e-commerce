<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\VendorRequest;
use App\Models\Main_Category;
use App\Models\Vendor;
use App\Notifications\VendorCreated;
use Illuminate\Http\Request;
use App\UploadImagesTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

use function PHPUnit\Framework\fileExists;

class VendorsController extends Controller
{
    use UploadImagesTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::selection()->paginate(10);
        return view('backend.vendors.index' , compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Main_Category::where('translation_of' , 0)->active()->get();
        return view('backend.vendors.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(VendorRequest $request)
{
    try {
        $file_path = '';

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            $file_path = $this->uploadimage('vendors', $request->logo);
        } else {
            return redirect()->route('admin.vendors.index')->with(['error' => 'Uploaded file is invalid or missing!']);
        }

        $vendor = Vendor::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'phone' => $request->phone,
            'email' => $request->email,
            'active' => $request->active,
            'logo' => $file_path,
            'password' => Hash::make($request->password),
        ]);
        $vendor->notify(new VendorCreated($vendor));

        //Notification::send($vendor , new VendorCreated($vendor));
        return redirect()->route('admin.vendors.index')->with(['success' => 'store saved successfully']);
    } catch (\Exception $ex) {
        return redirect()->route('admin.vendors.index')->with(['error' => 'there is a problem, please try later']);
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
        try {
            $vendors = Vendor::find($id);
            if(!$vendors){
                return redirect()->route('admin.vendors.index')->with(['error' => 'this vendor is not found']);
        }
            $categories = Main_Category::where('translation_of' , 0)->active()->get();
            return view('backend.vendors.edit' , compact('vendors','categories'));
        } catch (\Exception $ex) {
            return redirect()->route('admin.vendors.index')->with(['error' => 'there is a problem, please try later']);
    }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendorRequest $request, $id)
    {
        try{
            $vendors = Vendor::find($id);
            if(!$vendors){
                return redirect()->route('admin.vendors.index')->with(['error' => 'this vendor is not found']);
            }
            $file_path = $vendors->logo; 

            if ($request->hasFile('logo')) {
                if ($request->file('logo')->isValid()) {
                    $file_path = $this->uploadimage('vendors', $request->logo);
                } else {
                    return redirect()->route('admin.vendors.index')->with(['error' => 'Uploaded file is invalid!']);
                }
            }
            $data = [
                'name' => $request->name,
                'category_id' => $request->category_id,
                'phone' => $request->phone,
                'email' => $request->email,
                'active' => $request->active,
                'logo' => $file_path,
            ];

            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $vendors->update($data);

            return redirect()->route('admin.vendors.index')->with(['success' => 'the store updated successfully']);
        }catch(\Exception $ex){
            return redirect()->route('admin.vendors.index')->with(['error' => 'there is a problem, please try later']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( string $id)
    {
            try{
            $vendors = Vendor::find($id);
            
            if(!$vendors){
                return redirect()->route('admin.vendors.index')->with(['error' => 'this vendor is not found']);
            }

            $photo = Str::after($vendors->logo , 'assets/');
            $photo_path = public_path('assets/' . $photo);
            if(file_exists($photo_path)){
                unlink($photo_path);
            }
            $vendors->delete();
            return redirect()->route('admin.vendors.index')->with(['success' => 'the store deleted successfully']);
            }catch(\Exception $ex){
            return redirect()->route('admin.vendors.index')->with(['error' => 'there is a problem, please try later']);
        }
    }

    public function changestatus($id){
        try{
        $vendors = Vendor::find($id);
        if(!$vendors){
            return redirect()->route('admin.vendors.index')->with(['error' => 'this vendor is not found']);
        }
        $status = $vendors->active == 0 ? 1 : 0;
        $vendors->update(['active' => $status]);
            return redirect()->route('admin.vendors.index')->with(['success' => 'the status changed successfully']);
        }catch(\Exception $ex){
        return redirect()->route('admin.vendors.index')->with(['error' => 'there is a problem, please try later']);
        }
    }
}
