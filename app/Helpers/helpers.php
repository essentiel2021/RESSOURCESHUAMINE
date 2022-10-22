<?php

use Illuminate\Support\Str;


define("PAGELIST", "list");
define("PAGECREATEFORM", "create");
define("PAGEEDITFORM", "edit");
define("DEFAULTPASWWORD","Password@9419");

function userFullName(){
    return auth()->user()->lastName . " " . auth()->user()->name;
}
function getRolesName(){
    // $roleLibelle = "";
    // $i= 0;
    // foreach(auth()->user()->roles as $role){
    //     $roleLibelle .= $role->libelle;

    //     if($i < sizeof(auth()->user()->roles) - 1)
    //     {
    //         $roleLibelle .= " ,";
    //     }
    //     $i++;
    // }
    // return $roleLibelle;

    $rolesName = "";
    $i = 0;
    foreach(auth()->user()->roles as $role){
        $rolesName .= $role->libelle;

        if($i < sizeof(auth()->user()->roles) - 1 ){
            $rolesName .= ",";
        }

        $i++;
    }

    return $rolesName;
}

function contains($container, $contenu){
    return Str::contains($container, $contenu);
}

function setMenuClass($route,$class){
    $routeActuel = request()->route()->getName();
    if(contains($routeActuel,$route)){
        return $class;
    }
    return "";
}

function setMenuActive($route){
    $routeActuel = request()->route()->getName();
   if($routeActuel === $route){
        return "active";
   }
    return "";
}