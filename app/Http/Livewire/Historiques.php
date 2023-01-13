<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Historiques extends Component
{
    public $data = [];

    public function mount($id){
        $historiques = DB::table('employe_service')->where('employe_id', $id)
        ->join('employes', 'employe_service.employe_id', '=', 'employes.id')
        ->join('services', 'employe_service.service_id', '=', 'services.id')
        ->join('departements', 'services.departement_id', '=', 'departements.id')
        ->join('succursales', 'departements.succursale_id', '=', 'succursales.id')
        ->select('employes.photo as photo','employes.matricule as matricule','employes.nom as nom','employes.prenom as prenom', 'succursales.libelle as succursale', 'departements.libelle as departement', 'services.libelle as service', 'employe_service.date_debut', 'employe_service.date_fin','employe_service.is_end')
        ->paginate(5);
        $this->data = [
            "historiques" => $historiques
        ];
        

    }
    public function render()
    {
        return view('livewire.historiques.list',$this->data)->extends("layouts.master")->section("contenu");
    }
}
