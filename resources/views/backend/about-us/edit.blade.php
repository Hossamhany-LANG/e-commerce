@extends('layouts.admin')
@section('title', 'Edit Informations')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">edit information</h6>
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
            <form action="{{route('admin.about-us.update',$information->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="pagename">Page Name</label>
                            <input type="text" name="pagename" value="{{$information->pagename}}" class="form-control">
                            @error('pagename') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="phone">Telephone</label>
                            <input type="text" name="phone" value="{{$information->phone}}" class="form-control">
                            @error('phone') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{$information->email}}" class="form-control">
                            @error('email') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" value="{{$information->address}}" class="form-control">
                            @error('address') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="facebook">Facebook-Link</label>
                            <input type="text" name="facebook" value="{{$information->facebook}}" class="form-control">
                            @error('facebook') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="twitter">Twitter-Link</label>
                            <input type="text" name="twitter" value="{{$information->twitter}}" class="form-control">
                            @error('twitter') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="instagram">Instagram-Link</label>
                            <input type="text" name="instagram" value="{{$information->instagram}}" class="form-control">
                            @error('instagram') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="linkedin">Linkedin-Link</label>
                            <input type="text" name="linkedin" value="{{$information->linkedin}}" class="form-control">
                            @error('linkedin') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                                <textarea name="description" id="description" cols="30" rows="3" placeholder="Description">{{$information->description}}</textarea>
                            @error('description') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <img src="{{asset($information->image)}}" class="rounded-circle" height="250" width="250" alt="product photo">
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
                    <button type="submit" name="submit" class="btn btn-primary">Edit Information</button>
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

