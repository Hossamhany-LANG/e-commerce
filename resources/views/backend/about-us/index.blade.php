@extends('layouts.admin')
@section('title', 'Informations')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Information</h6>
            <div class="ml-auto">
                <a href="{{route('admin.about-us.create')}}" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Add New Information</span>
                </a>
            </div>
        </div>    
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>pagename</th>
                        <th>phone</th>
                        <th>email</th>
                        <th>address</th>
                        <th>description</th>
                        <th>facebook link</th>
                        <th>twitter link</th>
                        <th>instagram link</th>
                        <th>linkedin link</th>
                        <th>image</th>
                        <th class="text-center" style="width:30px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($information)
                    <tr>
                        <td>{{$information->pagename}}</td>
                        <td>{{$information->phone}}</td>
                        <td>{{$information->email}}</td>
                        <td>{{$information->address}}</td>
                        <td>{{$information->description}}</td>
                        <td>{{$information->facebook}}</td>
                        <td>{{$information->twitter}}</td>
                        <td>{{$information->instagram}}</td>
                        <td>{{$information->linkedin}}</td>
                        <td><img width="100" height="100" src="{{asset($information->image)}}"></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('admin.about-us.edit' , $information->id)}}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" 
                                onclick="if(confirm('Are you sure you want to delete this information?')){document.getElementById('delete-product-{{$information->id}}').submit();}else{return false;}"
                                    class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{route('admin.about-us.destroy' , $information->id)}}" method="POST" id="delete-product-{{$information->id}}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="9" class="text-center"> No Products Found</td>
                    </tr>
                    @endif
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
@endsection