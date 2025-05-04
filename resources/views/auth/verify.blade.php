@extends('layouts.app')
@section('title')
Reset Password
@endsection
@section('header')
@endsection
@section('content')

<section class="py-5">
    <div class="row">
        <div class="col-6 offset-3">
            <h1 class="h2 text-uppercase mb-0">{{ __('Verify Your Email Address') }}</h1>
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
            {{ __('Before proceeding, please check your email for a verification link.') }}
            {{ __('If you did not receive the email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
            </form>
        </div>
    </div>
</section>
@endsection
