<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SuccursaleController;
use App\Http\Livewire\Users;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('succursales',SuccursaleController::class);
Route::get('register',[RegisterController::class,'index'])->name('register');
Route::post('register',[RegisterController::class,'register'])->name('post.register');

Route::get('login',[LoginController::class,'index'])->name('login');
Route::post('login',[LoginController::class,'login'])->name('post.login');

Route::get('logout',[LogoutController::class,'logout'])->name('logout');

Route::get('forgot',[ForgotController::class,'index'])->name('forgot');
Route::post('forgot',[ForgotController::class,'store'])->name('post.forgot');

Route::get('reset/{token}',[ResetController::class,'index'])->name('reset');
Route::post('reset',[ResetController::class,'reset'])->name('post.reset');

Route::get('/',[HomeController::class,'index'])->name('home');

// Le groupe des routes relatives aux managers uniquement
Route::group([
    "middleware" =>["auth","auth.manager"],
    'as' => 'manager.'
],function(){
    Route::group(
        ["prefix" => "manager"],function(){
            Route::get("/users",Users::class)->name("users.index");
        }
    );
}
);