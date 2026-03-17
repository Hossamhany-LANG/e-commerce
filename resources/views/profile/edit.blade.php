@extends('layouts.app')
@section('title', 'Edit Profile')
@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body text-center">
            <form action="{{route('profile.update' , $user->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('Patch')
                <div class="row">
                    <div class="col-5">
                        <div class="form-group text-start">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" value="{{$user->first_name}}" class="form-control form-control-sm d-inline-block" style="width:250px;">
                            @error('first_name') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group text-start">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" value="{{$user->last_name}}" class="form-control form-control-sm d-inline-block" style="width:250px;">
                            @error('last_name') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group text-start">
                            <label for="username">User Name</label>
                            <input type="text" name="username" value="{{$user->username}}" class="form-control form-control-sm d-inline-block" style="width:250px;">
                            @error('username') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group text-start">
                            <label for="email">Email</label>
                            <input type="text" name="email" value="{{$user->email }}" class="form-control form-control-sm d-inline-block" style="width:250px;">
                            @error('email') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5">
                        <div class="form-group text-start">
                            <label for="mobile">Phone Number</label>
                            <input type="text" name="mobile" value="{{$user->mobile }}" class="form-control form-control-sm d-inline-block" style="width:250px;">
                            @error('mobile') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group text-start">
                            <label for="password">Password</label>
                            <input type="text" name="password" class="form-control form-control-sm d-inline-block" style="width:250px;">
                            @error('password') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group text-start">
                        <label for="user_image">Photo</label>
                        <img src="{{ asset('storage/'.$user->user_image) }}" class="rounded-circle" height="250" width="250" alt="profile photo">
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-12">
                        <br>
                        <div class="file-loading">
                            <input type="file" name="user_image" id="product-image" class="file-input-overview">
                            <span class="form-text text-muted">Image width should be 500px x 500px</span>
                            @error('user_image') <span class="text-danger">{{$message}}</span>@enderror
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
