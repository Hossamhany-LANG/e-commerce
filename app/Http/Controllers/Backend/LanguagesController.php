<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $languages = Language::paginate(10);
        return view('backend.languages.index' , compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $languages = Language::paginate(10);
        return view('backend.languages.create' , compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LanguageRequest $request)
    {
        try{
            Language::create([
                'name' => $request->name,
                'abbr' => $request->abbr,
                'direction' => $request->direction,
                'active' => $request->active,
            ]);
            return redirect()->route('admin.languages.index')->with(['success' => 'Language added successfully']);
        }catch(\Exception){
            return redirect()->route('admin.languages.index')->with(['error' => 'there is a problem, please try later']);
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
        $languages = Language::find($id);
        if(!$languages){
            return redirect()->route('admin.languages.index')->with(['error' => 'this language is not found']);
        } 
        return view('backend.languages.edit' , compact('languages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LanguageRequest $request , $id)
    {
        try{
            $languages = Language::find($id);
            if(!$languages){
                return redirect()->route('admin.languages.edit' , $id)->with(['error' => 'this language is not found']);
            } 
            $languages->update([
                'name' => $request->name,
                'abbr' => $request->abbr,
                'direction' => $request->direction,
                'active' => $request->active,
            ]);
            return redirect()->route('admin.languages.index')->with(['success' => 'Language updated successfully']);
        }catch(\Exception){
            return redirect()->route('admin.languages.index')->with(['error' => 'there is a problem, please try later']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $languages = Language::find($id);
            if(!$languages){
                return redirect()->route('admin.languages.index')->with(['error' => 'this language is not found']);
            } 
            $languages->delete();
            return redirect()->route('admin.languages.index')->with(['success' => 'Language deleted successfully']);
        }catch(\Exception){
            return redirect()->route('admin.languages.index')->with(['error' => 'there is a problem, please try later']);
        }
    }
}
