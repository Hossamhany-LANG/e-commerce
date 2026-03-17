@extends('layouts.app')
@section('title','Login')

@section('content')
<div class="login-wrapper">
    <div class="login-box">
        
        <div class="text-center mb-4">
            <h1 class="display-1 font-weight-bold" 
                style="color: #D10024 !important; font-size: 5rem; text-transform: uppercase; line-height: 1;">
                {{ config('app.name', 'MY SHOP') }}
            </h1>
            <p class="text-muted text-uppercase small" style="letter-spacing: 2px;">User Login Area</p>
        </div>

        <div class="custom-card-login">
            <form method="POST" action="{{ route('login') }}">
                @csrf   
                
                <div class="form-group">
                    <label class="text-uppercase font-weight-bold" style="font-size: 12px;">Username</label>
                    <input id="username" type="text" class="input" name="username" value="{{old('username')}}" placeholder="Username" required>        
                    @error('username')
                        <span class="text-danger small"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="text-uppercase font-weight-bold" style="font-size: 12px;">Password</label>
                    <input id="password" type="password" class="input" name="password" placeholder="Password" required>        
                    @error('password')
                        <span class="text-danger small"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="input-checkbox">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">
                            <span></span> Remember Me
                        </label>
                    </div>
                </div>

                <button class="primary-btn btn-block" type="submit">
                    LOGIN
                </button>

                <div class="text-center mt-4 pt-3" style="border-top: 1px solid #f1f1f1;">
                    @if (Route::has('password.request'))
                        <a class="text-muted small" href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                    <span class="mx-2 text-muted">|</span>
                    @if (Route::has('register'))
                        <a class="text-danger small font-weight-bold" href="{{ route('register') }}">Create Account</a>
                    @endif
                </div>
            </form>
        </div>
        
    </div>
</div>
@endsection