<?php

use App\Models\Employe;
use App\Models\Service;
use App\Http\Livewire\Users;
use App\Models\EmployeService;
use App\Http\Livewire\Employes;
use App\Http\Livewire\BlackList;
use App\Http\Livewire\NosServices;
use App\Http\Livewire\ServiceComp;
use App\Http\Livewire\Succursales;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Affectations;
use App\Http\Livewire\Departements;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Livewire\Historiques;

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
    "prefix" => "manager",'as' => 'manager.'
],function(){
    Route::group(
        ["prefix" => "gestcomptes","as" => "gestcomptes."],function(){
            Route::get("/users",Users::class)->name("users.index");
        }
    );
    Route::group([
        "prefix" => "gestsuccursales",'as' => 'gestsuccursales.'], function(){
        Route::get("/succursales", Succursales::class)->name("succursales");
        Route::get("/departements",Departements::class)->name("departements");
        Route::get("/departements/{id}/service",ServiceComp::class)->name("departements.service");
        Route::get("/services",NosServices::class)->name("service");
    });
    Route::group(
        ["prefix" => "gestaffectations","as" => "gestaffectations."],function(){
            Route::get("/historiques",Affectations::class)->name("historiques");
            Route::get("/historiques/{id}/list",Historiques::class)->name("historiques.list");
        }
    );
});


// Le groupe des routes relatives aux assistant uniquement
Route::group([
    "middleware" =>["auth","auth.assistant"],
    "prefix" => "assistant",'as' => 'assistant.'
],function(){
    Route::group(
        ["prefix" => "gestemployes","as" => "gestemployes."],function(){
            Route::get("/employes",Employes::class)->name("employe.index");
            Route::get("/blacklist",BlackList::class)->name("employe.black");
        }
    );
});

//les routes concernant le profil du compte

Route::get("user/edit",[UserController::class,"edit"])->name('user.edit');
Route::post("user/store",[UserController::class,"store"])->name('post.user');

Route::get('user/password', [UserController::class, 'password'])->name('user.password');

Route::post('password', [UserController::class, 'updatePassword'])->name('update.password');

Route::get("/employeServices",function (){
    $id = 2;
    // $historique = EmployeService::with(['employe', 'service', 'departement', 'succursale'])
    //         ->where('employe_id', $id)
    //         ->get();

    // $historique = Employe::where('id', $id)
    //             ->join('employe_service', 'employe.id', '=', 'employe_service.employe_id')
    //             ->join('service', 'employe_service.service_id', '=', 'service.id')
    //             ->join('departement', 'service.department_id', '=', 'department.id')
    //             ->join('succursale', 'department.succursale_id', '=', 'succursale.id')
    //             ->select('employe.nom as nom', 'succursale.libelle as succursale', 'department.libelle as department', 'service.libelle as service', 'employe_service.start_date', 'employe_service.end_date')
    //             ->get();
    // return $historique;

     $affectations = DB::table('employe_service')->where('employe_id', $id)
        ->join('employes', 'employe_service.employe_id', '=', 'employes.id')
        ->join('services', 'employe_service.service_id', '=', 'services.id')
        ->join('departements', 'services.departement_id', '=', 'departements.id')
        ->join('succursales', 'departements.succursale_id', '=', 'succursales.id')
        ->select('employes.photo as photo','employes.matricule as matricule','employes.nom as nom','employes.prenom as prenom', 'succursales.libelle as succursale', 'departements.libelle as departement', 'services.libelle as service', 'employe_service.date_debut', 'employe_service.date_fin')
        ->get();
    return $affectations ;
});

