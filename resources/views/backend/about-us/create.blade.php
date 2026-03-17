@extends('layouts.admin')
@section('title', 'Create Informations')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create an information</h6>
            <div class="ml-auto">
                <a href="{{route('admin.about-us.index')}}" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fa fa-home"></i>
                </span>
                <span class="text">Informations</span>
                </a>
            </div>
        </div>   
        <div class="card-body">
            <form action="{{route('admin.about-us.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="pagename">Page Name</label>
                            <input type="text" name="pagename" value="{{old('pagename')}}" class="form-control">
                            @error('pagename') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="phone">Telephone</label>
                            <input type="text" name="phone" value="{{old('phone')}}" class="form-control">
                            @error('phone') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{old('email')}}" class="form-control">
                            @error('email') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" value="{{old('address')}}" class="form-control">
                            @error('address') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="facebook">Facebook-Link</label>
                            <input type="text" name="facebook" value="{{old('facebook')}}" class="form-control">
                            @error('facebook') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="twitter">Twitter-Link</label>
                            <input type="text" name="twitter" value="{{old('twitter')}}" class="form-control">
                            @error('twitter') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="instagram">Instagram-Link</label>
                            <input type="text" name="instagram" value="{{old('instagram')}}" class="form-control">
                            @error('instagram') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="linkedin">Linkedin-Link</label>
                            <input type="text" name="linkedin" value="{{old('linkedin')}}" class="form-control">
                            @error('linkedin') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                                <textarea name="description" id="description" cols="30" rows="3" placeholder="Description"></textarea>
                            @error('description') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-12">
                        <label for="image">Photo</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="image" id="category-image" class="file-input-overview">
                            <span class="form-text text-muted">Image width should be 500px x 500px</span>
                            @error('image') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Add Information</button>
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
    });
</script>
@endsection

