<?php

namespace App\Http\Livewire;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class Users extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $currentPage = PAGELIST;

    public $newUser = [];

    public $editUser = [];

    public $rolePermissions = [];

    protected $validationAttributes = [
        'newUser.email' => 'Email',
        'newUser.lastName' => 'Prénom',
        'newUser.sexe' => 'Genre',
        'newUser.name' => 'Nom',
    ];
    public function render()
    {
        return view('livewire.users.index',[
            "users" => User::latest()->paginate(4)
        ])->extends("layouts.master")->section("contenu");
    }
    public function rules(){
        if($this->currentPage == PAGEEDITFORM){
            return [
                'editUser.name' => 'required',
                'editUser.lastName' => 'required',
                'editUser.email' => ['required', 'email', Rule::unique("users", "email")->ignore($this->editUser['id']) ],
                'editUser.sexe' => 'required',
            ];
        }
        else {
            return [
                'newUser.name' => 'required',
                'newUser.lastName' => 'required',
                'newUser.email' => 'required|email|unique:users,email',
                'newUser.sexe' => 'required',
            ];
        }
    }

    public function goToAddUser(){
        $this->currentPage = PAGECREATEFORM;
    }

    public function goToListUser(){
        $this->currentPage = PAGELIST;
        $this->editUser = [];
    }

    public function goToEditUser($id){
        $this->editUser = User::find($id)->toArray();
        $this->currentPage = PAGEEDITFORM;
        $this->populateRolePermissions();
    }
    public function populateRolePermissions(){
        $this->rolePermissions["roles"] = [];
        $this->rolePermissions["permissions"] = [];
        //logique pour charger les rôles et permissions
        $mapForCB = function($value){
            return $value["id"];
        };
        //recupere les id du tableau de role crée
        $roleIds = array_map($mapForCB,User::find($this->editUser["id"])->roles->toArray());
        $permissionIds = array_map($mapForCB,User::find($this->editUser["id"])->permissions->toArray());

        foreach(Role::all() as $role ){
            if(in_array($role->id,$roleIds)){
                array_push($this->rolePermissions["roles"], ["role_id"=>$role->id, "role_libelle"=>$role->libelle, "active"=>true]);
            }
            else{
                array_push($this->rolePermissions["roles"], ["role_id"=>$role->id, "role_libelle"=>$role->libelle, "active"=>false]);
            }
        }

        foreach(Permission::all() as $permission ){
            if(in_array($permission->id,$permissionIds)){
                array_push($this->rolePermissions["permissions"], ["permission_id"=>$permission->id, "permission_libelle"=>$permission->libelle, "active"=>true]);
            }
            else{
                array_push($this->rolePermissions["permissions"], ["permission_id"=>$permission->id, "permission_libelle"=>$permission->libelle, "active"=>false]);
            }
        }
    }
    public function addUser(){
        $validateAttribute = $this->validate();
        $validateAttribute['newUser']["password"] = "password";
        User::create($validateAttribute['newUser']);
        $this->newUser = [];
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Compte créé avec succès!"]);
    }
    public function updateRoleAndPermissions(){
        DB::table("user_role")->where("user_id", $this->editUser["id"])->delete();
        DB::table("user_permission")->where("user_id", $this->editUser["id"])->delete();
        foreach($this->rolePermissions["roles"] as $role){
            if($role["active"]){
                User::find($this->editUser["id"])->roles()->attach($role["role_id"]);
            }
        }

        foreach($this->rolePermissions["permissions"] as $permission){
            if($permission["active"]){
                User::find($this->editUser["id"])->permissions()->attach($permission["permission_id"]);
            }
        }
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Roles et permissions mis à jour avec succès!"]);
    }

    public function updateUser(){
        $validateAttribute = $this->validate();
        User::find($this->editUser["id"])->update($validateAttribute["editUser"]);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Mise à jour avec succès!"]);
    }
    public function confirmPwdReset(){

        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=>[
            'text' => "Vous êtes sur le point de rénitialiser le mot de passe de ce compte .Voulez vous continuer?",
            'title' =>"Êtes vous sûr de vouloir continuer?",
            'type' => "warning",
        ]]);
        
    }
    public function resetPassword(){
        User::find($this->editUser["id"])->update(["password" => bcrypt(DEFAULTPASWWORD)]);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Mot de passe du compte réinitialiser avec succès!"]);
    }
    public function confirmDelete($name,$id){

        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=>[
            'text' => "Vous êtes sur le point de supprimer le compte $name de la liste.Voulez vous continuer?",
            'title' =>"Êtes vous sûr de vouloir continuer?",
            'type' => "warning",
            'data' => [

                "user_id" => $id
            ]
        ]]);
    }
    public function deleteUser($id){
        DB::table("user_role")->where("user_id", $id)->delete();
        DB::table("user_permission")->where("user_id", $id)->delete();
        User::find($id)->delete();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Compte supprimé avec succès!"]);
    }
   
}
