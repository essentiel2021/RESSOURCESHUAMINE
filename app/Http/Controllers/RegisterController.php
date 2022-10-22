<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        $data = [
            'title' =>'Création de compte - '. config('app.name'),
            'description'  => 'Création de compte utilisateur '. config('app.name')
        ];
        return view('auth.register',$data);
    }

    public function register(Request $request){

        request()->validate([
            'name'=>'required|min:3|max:20|unique:users',
            'lastName'=>'required|min:3|max:20|',
            'email'=>'required|email|unique:users',
            'password'=>'required|between:9,20',
        ]);

        $user = new User();
        $user->name = request('name');
        $user->lastName = request('lastName');
        $user->email = request('email');
        $user->password = bcrypt( request('password') );
        $user->save();
        $success = "Compte crée.";
        return back()->withSuccess($success);

    }
}
