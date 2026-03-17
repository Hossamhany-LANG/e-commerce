@extends('layouts.admin')
@section('title', 'Vendors')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Stores</h6>
            <div class="ml-auto">
                <a href="{{route('admin.vendors.create')}}" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Add New Store</span>
                </a>
            </div>
        </div>   

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Logo</th>
                        <th>Phone</th>
                        <th>Main Category</th>
                        <th>Status</th>
                        <th class="text-center" style="width:30px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @forelse ($vendors as $vendor)
                    <tr>
                        <td>{{$vendor->name}}</td>
                        <td><img width="100" height="100" src="{{$vendor->logo}}"></td>
                        <td>{{$vendor->phone}}</td>
                        <td>{{$vendor->category->name}}</td>
                        <td>{{$vendor->getActive()}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('admin.vendors.changestatus' , $vendor->id)}}" class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                    @if ($vendor->active == 0)
                                        Enable
                                    @else
                                        Disable
                                    @endif
                                </a>
                                <a href="{{route('admin.vendors.edit' , $vendor->id)}}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" 
                                onclick="if(confirm('Are you sure you want to delete this vendor?')){document.getElementById('delete-vendor-{{$vendor->id}}').submit();}else{return false;}"
                                    class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{route('admin.vendors.destroy' , $vendor->id)}}" method="POST" id="delete-vendor-{{$vendor->id}}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center"> No Vendors Found</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="float-right">
                                {!! $vendors->appends(request()->all())->links()!!}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection