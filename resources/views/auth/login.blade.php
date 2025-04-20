@extends('layouts.app')
@section('content')
    

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                        <label for="username" class="text-small text-uppercase">Username</label>
                        <input type="text" class="form-control form-control-lg" name="username" value="{{old('username')}}" placeholder="Enter Your First Name">        
                            @error('username')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                        <label for="password" class="text-small text-uppercase">Password</label>
                        <input type="Password" class="form-control form-control-lg" name="Password" placeholder="Enter Your Password">        
                            @error('password')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <div class="custom-control cusom-checkbox">
                            <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remmber" class="custom-control-label text-small">{{ __('Remember Me') }}</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">{{ __('Login') }}</button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif

                            @if (Route::has('register'))
                            <a class="btn btn-secondary float-right" href="{{ route('register') }}">
                                {{ __('Have\'t an account?') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </form>

                @endsection