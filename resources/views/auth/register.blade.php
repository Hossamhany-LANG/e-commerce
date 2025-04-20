@extends('layouts.admin-auth')

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
            <h2 class="h5 text-uppercase mb-4">{{ __('Register')}}</h2>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                            <label for="first_name" class="text-small text-uppercase">First Name</label>
                            <input type="text" class="form-control form-control-lg" name="first_name" value="{{old('first_name')}}" placeholder="Enter Your First Name">        
                                @error('first_name')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="col-12">
                                <div class="form-group">
                            <label for="last_name" class="text-small text-uppercase">Last Name</label>
                            <input type="text" class="form-control form-control-lg" name="last_name" value="{{old('last_name')}}" placeholder="Enter Your Last Name">        
                                @error('last_name')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>    
                                <div class="col-12">
                                    <div class="form-group">
                                <label for="username" class="text-small text-uppercase">Username</label>
                                <input type="text" class="form-control form-control-lg" name="username" value="{{old('username')}}" placeholder="Enter Your User Name">        
                                    @error('username')
                                        <span class="text-danger">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email" class="text-small text-uppercase">E-mail Address</label>
                                    <input type="email" class="form-control form-control-lg" name="email" value="{{old('email')}}" placeholder="Enter Your E-mail">        
                                        @error('email')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="mobile" class="text-small text-uppercase">Phone Number</label>
                                    <input type="text" class="form-control form-control-lg" name="mobile" value="{{old('mobile')}}" placeholder="Enter Your Phone Number">        
                                        @error('mobile')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password" class="text-small text-uppercase">Password</label>
                                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Enter Your password">        
                                        @error('password')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password_confirmation" class="text-small text-uppercase">Password</label>
                                    <input type="password" class="form-control form-control-lg" name="password_confirmation" placeholder="Re type your Password">        
                                        @error('password_confirmation')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-dark">{{ __('Register') }}</button>
        
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