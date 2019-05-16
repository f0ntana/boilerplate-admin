<?php

namespace App\Modules\Users\Http\Controllers;

use App\Bootstrap\Http\Controllers\Controller;
use App\Modules\Users\Http\Requests\AuthenticateRequest;

class AuthenticateController extends Controller
{
    /**
     * Show Login Form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('layouts.login');
    }

    /**
     * Authentication Login
     *
     * @param AuthenticateRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function authenticate(AuthenticateRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->intended('/');
        }

        return redirect()
            ->to('login')
            ->with('error', 'Dados incorretos!')
            ->withInput($request->except('password'));
    }

    /**
     * Logout from Session
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout();
        session()->flush();
        return redirect()->to('/login');
    }
}
