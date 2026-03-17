@extends('layouts.admin')
@section('title', 'SubCategories')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">SubCategories</h6>
            <div class="ml-auto">
                <a href="{{route('admin.subcategories.create')}}" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Add New Subcategory</span>
                </a>
            </div>
        </div>    
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>SubCategory</th>
                        <th>Main Category</th>
                        <th>Status</th>
                        <th>Photo</th>
                        <th class="text-center" style="width:30px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @forelse ($subcategories as $subcategory)
                    <tr>
                        <td>{{$subcategory->name}}</td>
                        <td>{{$subcategory->maincategory->name}}</td>
                        <td>{{$subcategory->getActive()}}</td>
                        <td><img width="100" height="100" src="{{$subcategory->photo}}"></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('admin.subcategories.changestatus' , $subcategory->id)}}" class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                    @if ($subcategory->active == 0)
                                    Enable
                                    @else
                                    Disable    
                                    @endif
                                </a>
                                <a href="{{route('admin.subcategories.edit' , $subcategory->id)}}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" 
                                onclick="if(confirm('Are you sure you want to delete this category?')){document.getElementById('delete-subcategory-{{$subcategory->id}}').submit();}else{return false;}"
                                    class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{route('admin.subcategories.destroy' , $subcategory->id)}}" method="POST" id="delete-subcategory-{{$subcategory->id}}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center"> No SubCategories Found</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="float-right">
                                {!! $subcategories->appends(request()->all())->links()!!}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection