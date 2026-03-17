@extends('layouts.admin')
@section('title', 'Create Subcategory')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create a Subcategory</h6>
            <div class="ml-auto">
                {{-- @EntrustAbility::class('admin' , 'create_product_categories') --}}
                <a href="{{route('admin.subcategories.index')}}" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fa fa-home"></i>
                </span>
                <span class="text">subcategories</span>
                </a>
                {{-- @endEntrustAbility --}}
            </div>
        </div>   
        <div class="card-body">
            <form action="{{route('admin.subcategories.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="name">Subcategory Name</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control">
                            @error('name') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <label for="category_id">Main Category</label>
                        <select name="category_id" class="form-control">
                            <option value="" selected disabled>Choose Main Category</option>
                            @forelse ($main_categories as $main_category)
                                <option value="{{$main_category->id}}" {{old('category_id') == $main_category->id ? 'selected' :null}}>{{$main_category->name}}</option>
                            @empty 
                            @endforelse
                        </select>
                        @error('category_id') <span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-5">
                        <label for="active">Status</label>
                        <select name="active" class="form-control">
                            <option value="1" {{old('active') == 1 ? 'selected' :null}}>Active</option>
                            <option value="0" {{old('active') == 0 ? 'selected' :null}}>Inactive</option>
                        </select>
                        @error('active') <span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-12">
                        <label for="photo">Photo</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="photo" id="category-image" class="file-input-overview">
                            <span class="form-text text-muted">Image width should be 500px x 500px</span>
                            @error('photo') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Add Subcategory</button>
                </div>
            </form>
        </div>
    </div>    
@endsection
@section('script')
    <script>
        $(function(){
            $("#category-image").fileinput({
                theme: "fa4",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false
            });
        });
    </script>
@endsection