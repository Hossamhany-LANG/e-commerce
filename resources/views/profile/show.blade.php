@extends('layouts.app')
@section('title', 'Profile')
@section('content')
<div class="container py-5">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row align-items-center text-center">
                <div class="col-md-4 text-center">
                    <img src="{{ $user->user_image ? asset('storage/'.$user->user_image) : asset('images/avatar.jpg') }}"
                        class="rounded-circle border border-3 shadow" width="180" height="180" alt="User Image">
                </div>
                <div class="col-md-4 text-start">
                    <h3 class="fw-bold mb-1">{{ $user->first_name }} {{ $user->last_name }}</h3>
                    <p class="text-muted">@ {{ $user->username }}</p>
                    <a href="{{ route('profile.edit',$user->id) }}" class="btn btn-primary mt-3">Edit Profile</a>
                </div>
                <div class="col-md-4 text-start">
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Phone:</strong> {{ $user->mobile }}</p>
                    <p><strong>Member Since:</strong> {{ $user->created_at->format('Y-m-d') }}</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
