@extends('layouts.admin')
@section('title', 'Edit-Category')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Edit Category ({{$main_categories->name}}) :</h6>
            <div class="ml-auto">
                {{-- @EntrustAbility::class('admin' , 'create_product_categories') --}}
                <a href="{{route('admin.main_categories.index')}}" class="btn btn-primary">
                <span class="icon text-white-50">
                    <i class="fa fa-home"></i>
                </span>
                <span class="text">Categories</span>
                </a>
                {{-- @endEntrustAbility --}}
            </div>
        </div>   
        <div class="card-body">
            <h1><b>category data:</b></h1>
            <br>
            <form action="{{route('admin.main_categories.update' ,$main_categories->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$main_categories->id}}">
                <div class="row">
                    <div class="col-5">
                        <div class="form-group">
                            <label for="name_{{ $main_categories->id }}">Category Name ({{__('messages.' . $main_categories->translation_language )}}):</label>
                            <input id="name_{{ $main_categories->id }}" type="text" value="{{$main_categories->name}}" name="categories[{{ $main_categories->id }}][name]" value="" class="form-control">
                            @error("categories.$main_categories->id.name") <span class="text-danger">{{$message}}</span>@enderror

                        </div>
                    </div>
                    <div class="col-5">
                    <label for="active_{{ $main_categories->id }}">Status ({{__('messages.' . $main_categories->translation_language )}}):</label>
                    <select name="categories[{{ $main_categories->id }}][active]" class="form-control">
                            <option value="1" {{old('active' , $main_categories->active) == 1 ? 'selected' :null}}>active</option>
                            <option value="0" {{old('active' , $main_categories->active) == 0 ? 'selected' :null}}>inactive</option>
                    </select>
                    @error("categories.$main_categories->id.active") <span class="text-danger">{{$message}}</span>@enderror
                    </div>
                </div>
                <br>
                    <div class="col-5 hidden">
                        <div class="form-group">
                            <label for="abbr_{{ $main_categories->id }}">Abbreviation ({{__('messages.' . $main_categories->translation_language )}}):</label>
                            <input value="{{$main_categories->translation_language}}" id="abbr_{{ $main_categories->id }}" type="text" name="categories[{{ $main_categories->id }}][abbr]" value="" class="form-control">
                            @error("categories.$main_categories->id.abbr") <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                <br>
                <hr>
                <br>
                <div class="form-group">
                    <div class="text-center">
                        <img src="{{$main_categories->photo}}" class="rounded-circle" height="250" width="250" alt="category photo">
                    </div>
                </div>
                <div class="row pt-4">
                    <div class="col-12">
                        <label for="photo">Photo</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="photo" id="category-image" class="file-input-overview">
                            <span class="form-text text-muted">Image width should be 500px x 500px</span>
                            @error("photo") <span class="text-danger">{{$message}}</span>@enderror
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" class="btn btn-primary">Edit Category</button>
                </div>
            </form>
                <div class="row row-sm">

        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            @isset($main_categories ->categories)
                                            @foreach ($main_categories ->categories as $tarnslation)
                                            <li><a href="#{{$tarnslation->id}}" class="nav-link" data-toggle="tab">{{$tarnslation->translation_language}}</a></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">


                        <div class="tab-pane active" id="{{$tarnslation->id}}">
                            <div class="table-responsive mt-15">
                                <h1><b>category data:</b></h1>
                                <br>
                                <form action="{{route('admin.main_categories.update' ,$tarnslation->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="id" value="{{$tarnslation->id}}">
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="form-group">
                                                <label for="name_{{ $tarnslation->id }}">Category Name ({{__('messages.' . $tarnslation->translation_language )}}):</label>
                                                <input id="name_{{ $tarnslation->id }}" type="text" value="{{$tarnslation->name}}" name="categories[{{ $tarnslation->id }}][name]" value="" class="form-control">
                                                @error("categories.$tarnslation->id.name") <span class="text-danger">{{$message}}</span>@enderror

                                            </div>
                                        </div>
                                        <div class="col-5">
                                        <label for="active_{{ $tarnslation->id }}">Status ({{__('messages.' . $tarnslation->translation_language )}}):</label>
                                        <select name="categories[{{ $tarnslation->id }}][active]" class="form-control">
                                                <option value="1" {{old('active' , $tarnslation->active) == 1 ? 'selected' :null}}>active</option>
                                                <option value="0" {{old('active' , $tarnslation->active) == 0 ? 'selected' :null}}>inactive</option>
                                        </select>
                                        @error("categories.$tarnslation->id.active") <span class="text-danger">{{$message}}</span>@enderror
                                        </div>
                                    </div>
                                    <br>
                                        <div class="col-5 hidden">
                                            <div class="form-group">
                                                <label for="abbr_{{ $tarnslation->id }}">Abbreviation ({{__('messages.' . $tarnslation->translation_language )}}):</label>
                                                <input value="{{$tarnslation->translation_language}}" id="abbr_{{ $tarnslation->id }}" type="text" name="categories[{{ $tarnslation->id }}][abbr]" value="" class="form-control">
                                                @error("categories.$tarnslation->id.abbr") <span class="text-danger">{{$message}}</span>@enderror
                                            </div>
                                        </div>
                                    <br>
                                    <hr>
                                    <br>
                
                                    <div class="form-group pt-4">
                                        <button type="submit" class="btn btn-primary">Edit Category</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                                            @endforeach
                                            @endisset
                                            


                                        <div class="tab-pane" id="tab5">
                                            <div class="table-responsive mt-15">
                                                the second lang
                                            </div>
                                        </div>


                                        <div class="tab-pane" id="tab6">
                                            <!--المرفقات-->
                                           the third lang

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /div -->
        </div>

    </div>
        </div>
    </div>    
@endsection
@section('script')
    <script>
        $(function(){
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
        <!--- Tabs JS-->
<script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
<script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
@endsection