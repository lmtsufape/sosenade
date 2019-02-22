<?php

namespace SimuladoENADE\Http\Controllers\Auth;

use SimuladoENADE\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


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
    //protected $redirectTo = '/welcome';


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login (Request $request) {
        //echo $request['email'];
        $cred = ['email' => $request['email'],
                 'password' => $request['password']];
        if(Auth::attempt($cred)) {
            return redirect ("/");
            //echo "não eh aluno";
        } else {
            if(Auth::guard('aluno')->attempt($cred))
                //echo $request['email'];
                return view("teste");
            else
                echo "não logou";
        }
        
        exit(0);
    }
}