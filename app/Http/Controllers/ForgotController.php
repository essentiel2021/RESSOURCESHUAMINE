<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Notifications\PasswordResetNotification;

class ForgotController extends Controller
{
    public  function index()
    {
        $data = [
    		'title'=>'Oublie de mot de passe - '.config('app.name'),
    	];

    	return view('auth.forgot',$data);
    }

    public  function store()
    {
        request()->validate([
            'email'=>['required','email','exists:App\Models\User,email']
        ]);

        $token = Str::uuid();
        DB::table('password_resets')->insert(
            [
                'email' => request('email'),
                'token' => $token,
                'created_at' => now()
            ]
        );
        $user = User::whereEmail(request('email'))->firstOrFail();
        $user->notify(new PasswordResetNotification($token));
        $success = 'Vérifier votre boîte mail et suivez les instructions.';
    	return back()->withSuccess($success);
    }
}
