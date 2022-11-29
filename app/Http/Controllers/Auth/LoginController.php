<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as NewAuth;
use App\Http\Requests\Auth\LoginRequest;

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
        // dd('gfhfghffhfh');
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:influencer')->except('logout');
    }

    public function processLogin(Request $request)
    {   
        // dd($request->all());
        $credentials = $request->only('pub_id', 'password');
 
        if (NewAuth::attempt($credentials)) {
            return redirect('/influencer_graph');
        }
        // $request->authenticate();

        // if(auth()->user()){
        //     return redirect('/influencer_graph');
        // }
        // if($request->email)
        // {
        //     // dd($credentials);
            
        //     dd('wahan');
        //     return redirect()->back()->with('message','Credentials not matced in our records!');
        // }
        // dd('idhar aa');
        // return redirect()->back()->with('message','You are not an Influencer!');
    }
}
