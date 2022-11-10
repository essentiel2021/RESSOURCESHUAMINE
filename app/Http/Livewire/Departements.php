<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use Livewire\Component;

class Departements extends Component
{
    public function render()
    {
        $data = [
            "departements" => Departement::latest()->paginate(5), 
        ];
        //dd($data["departements"]);
        return view('livewire.departements.index',$data )->extends("layouts.master")->section("contenu");
    }
}
