<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
}
