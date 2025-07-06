@extends('layouts.admin')
@section('title', 'Edit-Store')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit Store ({{$vendors->name}}) :</h6>
            <div class="ml-auto">
                {{-- @EntrustAbility::class('admin' , 'create_product_categories') --}}
                <a href="{{route('admin.main_categories.index')}}" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fa fa-home"></i>
                </span>
                <span class="text">Stores</span>
                </a>
                {{-- @endEntrustAbility --}}
            </div>
        </div>   
        <div class="card-body">
            <h1><b>store data:</b></h1>
            <br>
            <form action="{{route('admin.vendors.update' , $vendors->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" value="{{$vendors->id}}">
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="name">Store Name</label>
                            <input id="name" type="text" name="name" value="{{$vendors->name}}" class="form-control">
                            @error("name") <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>


                    <div class="col-5">
                    <label for="category_id">Category</label>
                    <select name="category_id" class="form-control">
                        @if($categories && $categories->count() > 0)
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{$vendors->category_id == $category->id ? 'selected':null}}>{{$category->name}}</option>
                        @endforeach
                        @endif
                    </select>
                    @error('category_id') <span class="text-danger">{{$message}}</span>@enderror
                    </div>

                </div>
                <br>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input id="email" type="text" name="email" value="{{$vendors->email}}" class="form-control">
                            @error("email") <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input id="password" type="password" name="password" value="" class="form-control">
                            @error("password") <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input id="phone" type="text" name="phone" value="{{$vendors->phone}}" class="form-control">
                            @error("phone") <span class="text-danger">{{$message}}</span>@enderror                            
                        </div>                        
                    </div>
                    <div class="col-5">
                    <label for="active">Status:</label>
                    <select name="active" class="form-control">
                            <option value="1" {{$vendors->active == 1 ? 'selected' :null}}>active</option>
                            <option value="0" {{$vendors->active == 0 ? 'selected' :null}}>inactive</option> 
                    </select>
                    @error("active") <span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>    
                <br>
                <hr>
                <br>
                {{-- <div id="map" style="height: 500px;width: 1000px;"></div> --}}
                <br>
                <hr>
                <br>
                <div class="form-group">
                    <div class="text-center">
                        <img src="{{$vendors->logo}}" class="rounded-circle" height="250" width="250" alt="vendor photo">
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-12">
                        <label for="logo">Store Logo</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="logo" id="logo-image" class="file-input-overview">
                            <span class="form-text text-muted">Image width should be 500px x 500px</span>
                            @error("logo") <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">Edit Store</button>
                </div>
            </form>
                <div class="row row-sm">
    </div>
        </div>
    </div>    
@endsection
@section('script')
    <script>
        $(function(){
            $("#logo-image").fileinput({
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
        <!--- Tabs JS-->
<script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
<script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
@endsection