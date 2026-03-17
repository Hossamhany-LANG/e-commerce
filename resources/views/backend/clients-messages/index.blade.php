@extends('layouts.admin')
@section('title', 'Clients Messages')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Clients Messages</h6>
        </div>    
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Client Name</th>
                        <th>Client Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Send At</th>
                        <th class="text-center" style="width:30px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($messages as $message)
                    <tr>
                        <td>{{$message->name}}</td>
                        <td>{{$message->email}}</td>
                        <td>{{$message->subject}}</td>
                        <td><a href="{{route('show-client-message' , $message->id)}}">{{$message->message}}</a></td>
                        <td>{{$message->created_at}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="javascript:void(0);" 
                                onclick="if(confirm('Are you sure you want to delete this message?')){document.getElementById('delete-product-{{$message->id}}').submit();}else{return false;}"
                                    class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{route('delete_client_messages' , $message->id)}}" method="POST" id="delete-product-{{$message->id}}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center"> No Messages Found</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
@endsection