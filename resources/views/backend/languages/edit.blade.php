@extends('layouts.admin')
@section('title', 'Create-Languages')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">update language</h6>
            <div class="ml-auto">
                {{-- @EntrustAbility::class('admin' , 'create_product_categories') --}}
                <a href="{{route('admin.languages.index')}}" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fa fa-home"></i>
                </span>
                <span class="text">Languages</span>
                </a>
                {{-- @endEntrustAbility --}}
            </div>
        </div>   
        <div class="card-body">
            <h1><b>language({{$languages->name}}) data:</b></h1>
            <br>
            <form action="{{route('admin.languages.update' , $languages->id)}}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="name">Language Name</label>
                            <input id="name" type="text" name="name" value="{{old('name' , $languages->name)}}" class="form-control">
                            @error('name') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="abbr">Language Abbreviation</label>
                            <input id="abbr" type="text" name="abbr" value="{{old('abbr' , $languages->abbr)}}" class="form-control">
                            @error('abbr') <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <label for="direction">Direction</label>
                    <select name="direction" class="form-control">
                            <option value="rtl" {{old('direction' , $languages->direction) == 'rtl' ? 'selected' :null}}>from right to left</option>
                            <option value="ltr" {{old('direction' , $languages->direction) == 'ltr' ? 'selected' :null}}>from lift to right</option>
                        
                    </select>
                    @error('direction') <span class="text-danger">{{$message}}</span>@enderror
                </div>
                <br>
                <div class="col-3">
                    <label for="direction">Status</label>
                    <select name="active" class="form-control">
                            <option value="1"{{old('active' , $languages->active) == 1 ? 'selected' :null}}>active</option>
                            <option value="0"{{old('active' , $languages->active) == 0 ? 'selected' :null}}>inactive</option>    
                    </select>
                    @error('active') <span class="text-danger">{{$message}}</span>@enderror
                </div>
                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">update  Language</button>
                </div>
            </form>
        </div>
    </div>    
@endsection
