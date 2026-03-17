@extends('layouts.app')
@section('title', 'page Informations')
@section('content')
<table class="table table-bordered">
    <tbody>
        <tr>
            <th style="width:200px;">Page Name</th>
            <td>{{ $information->pagename }}</td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>{{ $information->phone }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $information->email }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $information->address }}</td>
        </tr>
        <tr>
            <th>Facebook</th>
            <td>
                <a href="{{ $information->facebook }}" target="_blank">
                    {{ $information->facebook }}
                </a>
            </td>
        </tr>
        <tr>
            <th>Twitter</th>
            <td>
                <a href="{{ $information->twitter }}" target="_blank">
                    {{ $information->twitter }}
                </a>
            </td>
        </tr>
        <tr>
            <th>Instagram</th>
            <td>
                <a href="{{ $information->instagram }}" target="_blank">
                    {{ $information->instagram }}
                </a>
            </td>
        </tr>
        <tr>
            <th>LinkedIn</th>
            <td>
                <a href="{{ $information->linkedin }}" target="_blank">
                    {{ $information->linkedin }}
                </a>
            </td>
        </tr>
        <tr>
            <th>Description</th>
            <td>{{ $information->description }}</td>
        </tr>
    </tbody>
</table>

@endsection

