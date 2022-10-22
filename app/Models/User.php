<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use  Notifiable;

    protected $fillable = [
        'name',
        'lastName',
        'sexe',
        'email',
        'password',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }
    
    public function permissions(){
        return $this->belongsToMany(Permission::class, 'user_permission', 'user_id', 'permission_id');
    }

    public function hasRole($role)
    {
        return $this->roles()->where("libelle",$role)->first() ==! null;
    }

    public function hasAnyRoles($roles)
    {
        return $this->roles()->whereIn("libelle",$roles)->first() ==! null;
    }

    public function getAllRoleNamesAttribute(){
        return $this->roles->implode("libelle", ' | ');
    }
}
