@extends('layouts.admin')
@section('title', 'Admin Profile')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Profile</h6>
        </div>    
        <div class="table-responsive">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th style="width:200px;">First Name</th>
                        <td>{{ $admin->first_name }}</td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td>{{ $admin->last_name }}</td>
                    </tr>
                    <tr>
                        <th>User Name</th>
                        <td>{{ $admin->username  }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $admin->email  }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $admin->mobile  }}</td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td>
                            <img class="img-profile rounded-circle"src="{{asset('storage/'.$admin->user_image)}}">
                        </td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-primary"><a href="{{route('admin.adminprofile.edit')}}">Edit Profile</a></button>
        </div>
    </div>
@endsection