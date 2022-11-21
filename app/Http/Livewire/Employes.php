<?php

namespace App\Http\Livewire;

use App\Models\Commune;
use App\Models\Employe;
use App\Models\SituationMatrimoniale;
use Livewire\Component;
use Livewire\WithPagination;

class Employes extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $search = "";
    
    public $currentPage = PAGELISTEMPLOYE;
    public $filtreSituaion = "";
    public $filtreCommune = "";
    public $filtreblack = "";
    public function render()
    {
        $employeQuery = Employe::query();

         if($this->search != ""){
            $employeQuery->where("nom", "LIKE",  "%". $this->search ."%")
                    ->orWhere("matricule","LIKE",  "%". $this->search ."%")
                    ->orWhere("prenom","LIKE",  "%". $this->search ."%");
        }

        if($this->filtreCommune != ""){
            $employeQuery->where("commune_id",$this->filtreCommune);
        }
        if($this->filtreSituaion != ""){
            $employeQuery->where("situation_matrimoniale_id",$this->filtreSituaion);
        }
        
        if($this->filtreblack != ""){
            $employeQuery->where("blackList",$this->filtreblack);
        }
        $data = [
            "employes" => $employeQuery->latest()->paginate(5),
            "communeemployes" => Commune::orderBy("libelle","ASC")->get(),
            "situationemployes" => SituationMatrimoniale::orderBy("libelle","ASC")->get(),
        ];

        return view('livewire.employes.index',$data)->extends("layouts.master")->section("contenu");
    }

    public function goToAddEmployee(){
        $this->currentPage = PAGECREATEFORMTEMPLOYE;
    }

    public function goToListEmployee(){
        $this->currentPage = PAGELISTEMPLOYE;
    }

    public function goToEditEmployee(){
        $this->currentPage = PAGEEDITFORMTEMPLOYE;
    }
   
}
