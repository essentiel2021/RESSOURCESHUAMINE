<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->except('profile');
    }
    public function profile(User $user)
    {
        return "Je". $user->name;
    }

    public function edit(){
        $user = auth()->user();
        $data = [
            'title' => $description = 'Editer mon Profil',
            'description'  => $description,
            'user' => $user
        ];
        return view("auth.edit",$data);
    }
    public function store(){
        $user = auth()->user();
        $user = User::updateOrCreate(['id'=>$user->id],request()->validate([
            'name'=>['required', 'min:3', 'max:20', Rule::unique('users')->ignore($user)],
            'lastName'=>['required', 'min:3', 'max:20', Rule::unique('users')->ignore($user)],
            'email'=>['required', 'email', Rule::unique('users')->ignore($user)],
        ]));
        $success = 'Informations mises à jour.';
    	return back()->withSuccess($success);
    }
    public function password(){
        $data = [
    		'title' => $description = 'Modifier mon mot de passe',
    		'description'=>$description,
    		'user'=>auth()->user(),
    	];
        return view("auth.password",$data);
    }
    public function updatePassword(){

        request()->validate([
    		'current'=>'required|password',
    		'password'=>'required|confirmed',
    	]);

    	$user = auth()->user();

        $user->password = bcrypt(request('password'));

    	$user->save();

    	$success = 'Mot de passe mis à jour.';
    	return back()->withSuccess($success);

    }
}
