<?php

namespace SimuladoENADE\Http\Controllers\Auth;

use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use SimuladoENADE\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest');
    }


    protected function guard()
    {
        return Auth::guard(request()->get('tipo_usuario'));
    }
    public function broker()
    {
        return Password::broker(request()->get('tipo_usuario'));
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email, 'tipo_usuario' => $request->tipo_usuario]
        );
    }

}
