<?php

namespace Pingu\User\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Pingu\Core\Http\Controllers\BaseController;
use Pingu\User\Forms\LoginForm;

class LoginController extends BaseController
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $form = new LoginForm();
        return view('user::login')->with(['form' => $form]);
    }

    protected function authenticated(Request $request, $user)
    {
        if($redirect = $request->session()->pull('redirect', false)) {
            $this->redirectTo = $redirect;
        }
    }
}
