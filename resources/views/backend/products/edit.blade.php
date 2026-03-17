@extends('layouts.admin')
@section('title', 'Edit Product')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit Product {{$product->name}}</h6>
            <div class="ml-auto">
                <a href="{{route('admin.products.index')}}" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fa fa-home"></i>
                </span>
                <span class="text">Products</span>
                </a>
            </div>
        </div>   
        <div class="card-body">
            <form action="{{route('admin.products.update' , $product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$product->id}}">
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" value="{{$product->name}}" class="form-control">
                            @error('name') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @forelse ($categories as $category)
                                <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' :null}}>{{$category->name}}</option>
                            @empty 
                            @endforelse
                        </select>
                        @error('category_id') <span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>
                <div class="row">
                        <div class="col-5">
                        <label for="subcategory_id">Subcategory</label>
                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                            <option value="" selected disabled>Choose Subcategory</option>
                        </select>
                        @error('subcategory_id') <span class="text-danger">{{$message}}</span>@enderror
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" name="price" value="{{$product->price}}" class="form-control">
                            @error('price') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-5">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" name="quantity" value="{{$product->quantity}}" class="form-control">
                            @error('quantity') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    
                    <div class="col-5">
                        <div class="form-group">
                            <label for="description">Discription</label>
                            <input type="text" name="description" value="{{$product->description}}" class="form-control">
                            @error('description') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                
                    <div class="col-5">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{old('status') == 1 ? 'selected' :null}}>Active</option>
                            <option value="0" {{old('status') == 0 ? 'selected' :null}}>Inactive</option>
                        </select>
                        @error('status') <span class="text-danger">{{$message}}</span>@enderror
                    </div>
                <div class="form-group">
                    <div class="text-center">
                        <img src="{{$product->photo}}" class="rounded-circle" height="250" width="250" alt="product photo">
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-12">
                        <label for="photo">Photo</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="photo" id="product-image" class="file-input-overview">
                            <span class="form-text text-muted">Image width should be 500px x 500px</span>
                            @error('photo') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Edit Product</button>
                </div>
            </form>
        </div>
    </div>    
@endsection
@section('script')
<script>
    $(function(){
        // File input config
        $("#product-image").fileinput({
            theme: "fa4",
            maxFileCount: 1,
            allowedFileTypes: ['image'],
            showCancel: true,
            showRemove: false,
            showUpload: false,
            overwriteInitial: false
        });

        // Dynamic subcategory load
        $('#category_id').on('change', function(){
            var categoryId = $(this).val();
            if(categoryId){
                $.ajax({
                    url: '/admin/subcategories-by-category/' + categoryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#subcategory_id').empty();
                        $('#subcategory_id').append('<option value="" disabled selected>Choose Subcategory</option>');
                        $.each(data, function(key, subcategory){
                            $('#subcategory_id').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');
                        });
                    }
                });
            }
        });
    });
</script>
        <!--- Tabs JS-->
<script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
<script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
@endsection







