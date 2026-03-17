@extends('layouts.admin')
@section('title', 'Create Product')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create a Product</h6>
            <div class="ml-auto">
                {{-- @EntrustAbility::class('admin' , 'create_product_categories') --}}
                <a href="{{route('admin.products.index')}}" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fa fa-home"></i>
                </span>
                <span class="text">Products</span>
                </a>
                {{-- @endEntrustAbility --}}
            </div>
        </div>   
        <div class="card-body">
            <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control">
                            @error('name') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="" selected disabled>Choose Category</option>
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
                            <input type="text" name="price" value="{{old('price')}}" class="form-control">
                            @error('price') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="text" name="quantity" value="{{old('quantity')}}" class="form-control">
                            @error('quantity') <span class="text-danger">{{$message}}</span>@enderror
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
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="description">Discription</label>
                            <input type="text" name="description" value="{{old('description')}}" class="form-control">
                            @error('description') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
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
                    <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
                </div>
            </form>
        </div>
    </div>    
@endsection
@section('script')
<script>
    $(function(){
        // File input config
        $("#category-image").fileinput({
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
@endsection

