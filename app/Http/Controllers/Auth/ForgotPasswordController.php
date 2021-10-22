<?php

namespace SimuladoENADE\Http\Controllers\Auth;

use Cookie;
use Illuminate\Support\Facades\Password;
use SimuladoENADE\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function broker()
    {
        return Password::broker(request()->tipo_usuario);
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email')->with('tipo_usuario', request()->tipo_usuario);
    }

}
