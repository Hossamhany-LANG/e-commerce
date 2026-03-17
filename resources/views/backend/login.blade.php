@extends('layouts.admin-auth')
@section('title', 'Login')

@section('content')
<div class="card login-fullscreen m-0 p-0 border-0 bg-white">
    <div class="card-body p-0 m-0">
        <div class="row no-gutters m-0 p-0 justify-content-center align-items-center" style="height: 100vh;">
            
            <div class="col-lg-5 col-md-7 col-sm-10">
                <div class="p-4">
                    <div class="text-center mb-4">
                        <h1 class="display-4 font-weight-bold text-primary mb-2" style="letter-spacing: -1px;">
                            {{ config('app.name', 'MY E-SHOP') }}
                        </h1>
                        <p class="text-muted text-uppercase small tracking-widest" style="letter-spacing: 0.2em;">Ecommerce Management System</p>
                    </div>

                    <div class="card shadow-sm border-0 p-3" style="border-radius: 15px; background: #fdfdfd;">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h5 class="text-gray-900 font-weight-bold">Administrator Login</h5>
                            </div>
                            
                            <form class="user" action="{{route('login')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="small font-weight-bold text-dark">Username</label>
                                    <input type="text" name="username" value="{{old('username')}}" class="form-control form-control-user shadow-sm" placeholder="Enter your username...">
                                    @error('username')
                                        <span class="text-danger small">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="small font-weight-bold text-dark">Password</label>
                                    <input type="password" class="form-control form-control-user shadow-sm" name="password" placeholder="Enter your password">
                                    @error('password')
                                        <span class="text-danger small">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{old('remember') ? 'checked' : ''}}>
                                        <label class="custom-control-label" for="remember">Remember Me</label>
                                    </div>
                                </div>
                                <button type="submit" name="login" class="btn btn-primary btn-user btn-block shadow-sm py-2">
                                    <strong>LOGIN</strong>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <a class="small text-muted font-weight-bold" href="{{route('admin.forgot_password')}}">Forgot Password?</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection