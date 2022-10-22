<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index(){
        
        $data = [
            'title' =>'Login - '. config('app.name'),
            'description'  => 'Connexion à votre compte '. config('app.name')
        ];
        return view('auth.login',$data);
    }

    public function login(Request $request)
    {
        Auth::logout();
        request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $remember = request()->has('remember');
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')], $remember)) {
            //dd(Auth::user());
            return redirect('/');
        }
        return back()->withError('Mauvais identifients.')->withInput();
    }
}
