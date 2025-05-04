@extends('layouts.app')
@section('title')
Register
@endsection
@section('header')
@endsection
@section('content')
<section class="py-5 bg-light">
    <div class="container">
        <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
            <div class="col-lg-6">
                <h1 class="h2 text-uppercase mb-0">Register</h1>
            </div>
            <div class="col-lg-6 text-lg-right">
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="row">
        <div class="col-6 offset-3">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                            <label for="first_name" class="text-small text-uppercase custom-label">First Name</label>
                            <input id="first_name" type="text" class="form-control form-control-lg custom-input" name="first_name" value="{{old('first_name')}}" placeholder="Enter Your First Name">        
                                @error('first_name')
                                    <span class="text-danger custom-label">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="col-12">
                                <div class="form-group">
                            <label for="last_name" class="text-small text-uppercase custom-label">Last Name</label>
                            <input id="last_name" type="text" class="form-control form-control-lg custom-input" name="last_name" value="{{old('last_name')}}" placeholder="Enter Your Last Name">        
                                @error('last_name')
                                    <span class="text-danger custom-label">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>    
                                <div class="col-12">
                                    <div class="form-group">
                                <label for="username" class="text-small text-uppercase custom-label">Username</label>
                                <input id="username" type="text" class="form-control form-control-lg custom-input" name="username" value="{{old('username')}}" placeholder="Enter Your User Name">        
                                    @error('username')
                                        <span class="text-danger custom-label">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email" class="text-small text-uppercase custom-label">E-mail Address</label>
                                    <input id="email" type="email" class="form-control form-control-lg custom-input" name="email" value="{{old('email')}}" placeholder="Enter Your E-mail">        
                                        @error('email')
                                            <span class="text-danger custom-label">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="mobile" class="text-small text-uppercase custom-label">Phone Number</label>
                                    <input id="mobile" type="text" class="form-control form-control-lg custom-input" name="mobile" value="{{old('mobile')}}" placeholder="Enter Your Phone Number">        
                                        @error('mobile') 
                                            <span class="text-danger custom-label">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password" class="text-small text-uppercase custom-label">Password</label>
                                    <input id="password" type="password" class="form-control form-control-lg custom-input" name="password" placeholder="Enter Your password">        
                                        @error('password')
                                            <span class="text-danger custom-label">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password_confirmation" class="text-small text-uppercase custom-label">Password</label>
                                    <input id="password_confirmation" type="password" class="form-control form-control-lg custom-input" name="password_confirmation" placeholder="Re type your Password">        
                                        @error('password_confirmation')
                                            <span class="text-danger custom-label">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-12 custom-label">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger">{{ __('Register') }}</button>
        
                                    @if (Route::has('login'))
                                        <a class="btn btn-link" href="{{ route('login') }}">
                                            {{ __('Have an account?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>        
                </div>
            </div>
</section>
@endsection        