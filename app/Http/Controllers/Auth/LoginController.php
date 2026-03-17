<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    public function username()
    {
        return 'username';
    }
    public function redirectTo(){
        if(Auth::user()->roles->first()->allowed_route != ''){
            return $this->redirectTo = Auth::user()->roles->first()->allowed_route . '/index';
        }
    }
    public function loginpage(){
        return view('backend.login'); 
    }

    public function logout(\Illuminate\Http\Request $request){
        Auth::guard('admin')->logout();             
        $request->session()->invalidate();     
        $request->session()->regenerateToken();

        return redirect('/login');            
    }
    public function admin_logout(\Illuminate\Http\Request $request)
{
    Auth::guard('admin')->logout();
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('admin.login_page')
        ->withHeaders([
            'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
            'Pragma'        => 'no-cache',
            'Expires'       => 'Sat, 01 Jan 1990 00:00:00 GMT',
        ]);
}

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'admin_logout']);
        $this->middleware('auth')->only('logout');
    }

}
