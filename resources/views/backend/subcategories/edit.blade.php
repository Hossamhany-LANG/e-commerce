@extends('layouts.admin')
@section('title', 'Edit Subcategory')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit {{$subcategory->name}}</h6>
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
            <form action="{{route('admin.subcategories.update' , $subcategory->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$subcategory->id}}">
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="name">Subcategory Name</label>
                            <input type="text" name="name" value="{{$subcategory->name}}" class="form-control">
                            @error('name') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <label for="category_id">Main Category</label>
                        <select name="category_id" class="form-control">
                            @foreach ($main_categories as $main_category)
                                <option value="{{$main_category->id}}" {{old('category_id') == $main_category->id ? 'selected' :null}}>{{$main_category->name}}</option>
                            @endforeach
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
                <div class="form-group">
                    <div class="text-center">
                        <img src="{{$subcategory->photo}}" class="rounded-circle" height="250" width="250" alt="product photo">
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
                    <button type="submit" name="submit" class="btn btn-primary">Edit {{$subcategory->name}}</button>
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