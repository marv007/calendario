<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    // Login form
    public function showLoginForm(){
      $pageConfigs = ['bodyCustomClass' => 'bg-full-screen-image blank-page'];
  
        return view('/auth/login', [
            'pageConfigs' => $pageConfigs
      ]);
    }

    /**
     * Login.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function login(Request $request)
    {  
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);
        //$credentials = $request->only('email', 'password');
        $credentials = ['user_email' => $request['email'], 'password' => $request['password'], 'user_status' => 'active'];
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/home');
        }else{    
            return $credentials;
            return redirect('/login')->withErrors(['email' => 'Oppes! You have entered invalid credential'])
            ->withInput(request(['email']));
        }
    }

    

     /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/login');
    }

}
