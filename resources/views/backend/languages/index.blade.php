@extends('layouts.admin')
@section('title', 'Languages')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Languages</h6>
        </div>    

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Abbreviation</th>
                        <th>Direction</th>
                        <th>Status</th>
                        <th class="text-center" style="width:30px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($languages)
                    @foreach ($languages as $language)
                    <tr>
                        <td>{{$language->name}}</td>
                        <td>{{$language->abbr}}</td>
                        <td>{{$language->direction}}</td>
                        <td>{{$language->getActive()}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{route('admin.languages.edit' , $language->id)}}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" 
                                onclick="if(confirm('Are you sure you want to delete this language?')){document.getElementById('delete-language-{{$language->id}}').submit();}else{return false;}"
                                    class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{route('admin.languages.destroy' , $language->id)}}" method="POST" id="delete-language-{{$language->id}}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" class="text-center"> No languages Found</td>
                    </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <div class="float-right">
                                {!! $languages->appends(request()->all())->links()!!}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection