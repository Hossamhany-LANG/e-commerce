@extends('layouts.admin')
@section('title', 'Main Categories')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Main Categories</h6>
        </div>    

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Language</th>
                        <th>Status</th>
                        <th>Photo</th>
                        <th class="text-center" style="width:30px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @forelse ($main_categories as $main_category)
                    <tr>
                        <td>{{$main_category->name}}</td>
                        <td>{{Config::get('app.locale')}}</td>
                        <td>{{$main_category->getActive()}}</td>
                        <td><img width="100" height="100" src="{{$main_category->photo}}"></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('admin.main_categories.changestatus' , $main_category->id)}}" class="btn btn-outline-warning btn-min-width box-shadow-3 mr-1 mb-1">
                                    @if ($main_category->active == 0)
                                    Enable
                                    @else
                                    Disable    
                                    @endif
                                </a>
                                <a href="{{route('admin.main_categories.edit' , $main_category->id)}}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" 
                                onclick="if(confirm('Are you sure you want to delete this category?')){document.getElementById('delete-category-{{$main_category->id}}').submit();}else{return false;}"
                                    class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{route('admin.main_categories.destroy' , $main_category->id)}}" method="POST" id="delete-category-{{$main_category->id}}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center"> No Categories Found</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="float-right">
                                {{-- {!! $main_categories->appends(request()->all())->links()!!} --}}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection