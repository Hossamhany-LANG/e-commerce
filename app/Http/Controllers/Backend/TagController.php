<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\TagRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        // if (Auth::user()->role !== 'admin' || !Auth::user()->hasPermissionTo('manage_tags','show_tags')) {
        //     return redirect('admin/index');
        // }
        $tags = Tag::with('products')
        ->when(\request()->keyword != null,function($query){
            $query->search(\request()->keyword);
        })
        ->when(\request()->status != null,function($query){
            $query->whereStatus(\request()->status);
        })
        ->orderBy(\request()->sort_by ?? 'id' , \request()->order_by ?? 'desc')
        ->paginate(\request()->limit_by ?? 10);
        return view('backend.tags.index' , compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if (Auth::user()->role !== 'admin' || !Auth::user()->hasPermissionTo('create_tags')) {
        //     return redirect('admin/index');
        // }
        return view('backend.tags.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        // if (Auth::user()->role !== 'admin' || !Auth::user()->hasPermissionTo('create_tags')) {
        //     return redirect('admin/index');
        // }
        // $input['name'] = $request->name;
        // $input['status'] = $request->status;

        Tag::create($request->validated());
        return redirect()->route('admin.tags.index')->with([
            'message' => 'Created successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // if (Auth::user()->role !== 'admin' || !Auth::user()->hasPermissionTo('display_tags')) {
        //     return redirect('admin/index');
        // }
        return view('backend.tags.show');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        // if (Auth::user()->role !== 'admin' || !Auth::user()->hasPermissionTo('update_tags')) {
        //     return redirect('admin/index');
        // }
        return view('backend.tags.edit' , compact('tag'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, Tag $Tag)
    {
        // if (Auth::user()->role !== 'admin' || !Auth::user()->hasPermissionTo('update_tags')) {
        //     return redirect('admin/index');
        // }
        $input['name'] = $request->name;
        $input['slug'] = null;
        $input['status'] = $request->status;
        
        $Tag->update($input);
        return redirect()->route('admin.tags.index')->with([
            'message' => 'Updated successfully',
            'alert-type' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        // if (Auth::user()->role !== 'admin' || !Auth::user()->hasPermissionTo('delete_tags')) {
        //     return redirect('admin/index');
        // }
        $tag->delete();
        return redirect()->route('admin.tags.index')->with([
            'message' => 'Deleted successfully',
            'alert-type' => 'success'
        ]);
    }
}
