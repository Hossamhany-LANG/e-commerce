@extends('layouts.admin')
@section('title', 'Edit Admin Profile')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">edit Profile</h6>
        </div>   
        <div class="card-body">
            <form action="{{route('admin.adminprofile.update',$admin->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" value="{{$admin->first_name}}" class="form-control">
                            @error('first_name') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" value="{{$admin->last_name}}" class="form-control">
                            @error('last_name') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" name="password" class="form-control">
                            @error('password') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="username">UserName</label>
                            <input type="text" name="username" value="{{$admin->username}}" class="form-control">
                            @error('username') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{$admin->email}}" class="form-control">
                            @error('email') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="mobile">Phone</label>
                            <input type="text" name="mobile" value="{{$admin->mobile}}" class="form-control">
                            @error('mobile') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="form-group">
                    <div class="text-center">
                        <label for="user_image">Photo</label>
                        <img src="{{asset('storage/'.$admin->user_image)}}" class="rounded-circle" height="250" width="250" alt="Admin photo">
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-12">
                        <br>
                        <div class="file-loading">
                            <input type="file" name="user_image" id="user_image" class="file-input-overview">
                            <span class="form-text text-muted">Image width should be 500px x 500px</span>
                            @error('user_image') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Edit Profile</button>
                </div>
            </form>
        </div>
    </div>    
@endsection
@section('script')
<script>
    $(function(){
        // File input config
        $("#user_image").fileinput({
            theme: "fa4",
            maxFileCount: 1,
            allowedFileTypes: ['user_image'],
            showCancel: true,
            showRemove: false,
            showUpload: false,
            overwriteInitial: false
        });
    });
</script>
@endsection

