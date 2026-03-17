@extends('layouts.admin')
@section('title', 'Create-Category')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Add a new category</h6>
            <div class="ml-auto">
                <a href="{{route('admin.main_categories.index')}}" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fa fa-home"></i>
                </span>
                <span class="text">Categories</span>
                </a>
            </div>
        </div>   
        <div class="card-body">
            <h1><b>category data:</b></h1>
            <br>
            <form action="{{route('admin.main_categories.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if($languages->count() > 0)
                @foreach ($languages as $language)
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="name_{{ $language->id }}">Category Name ({{__('messages.' . $language->abbr )}}):</label>
                            <input id="name_{{ $language->id }}" type="text" name="categories[{{ $language->id }}][name]" value="" class="form-control">
                            @error("categories.$language->id.name") <span class="text-danger">{{$message}}</span>@enderror

                        </div>
                    </div>
                    <div class="col-5">
                    <label for="active_{{ $language->id }}">Status ({{__('messages.' . $language->abbr )}}):</label>
                    <select name="categories[{{ $language->id }}][active]" class="form-control">
                            <option value="1" {{old('active') == 1 ? 'selected' :null}}>active</option>
                            <option value="0" {{old('active') == 0 ? 'selected' :null}}>inactive</option> 
                    </select>
                    @error("categories.$language->id.active") <span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>
                <br>
                    <div class="col-5 hidden">
                        <div class="form-group">
                            <label for="abbr_{{ $language->id }}">Abbreviation ({{__('messages.' . $language->abbr )}}):</label>
                            <input value="{{$language->abbr}}" id="abbr_{{ $language->id }}" type="text" name="categories[{{ $language->id }}][abbr]" value="" class="form-control">
                            @error("categories.$language->id.abbr") <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                <br>
                <hr>
                <br>
                @endforeach
                @endif
                <div class="row pt-4">
                    <div class="col-12">
                        <label for="photo">Photo</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="photo" id="category-image" class="file-input-overview">
                            <span class="form-text text-muted">Image width should be 500px x 500px</span>
                            @error("photo") <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">Add Category</button>
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