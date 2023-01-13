<?php

namespace App\Http\Livewire;

use App\Models\Commune;
use App\Models\Employe;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PieceIdentite;
use App\Models\EmployeService;
use Illuminate\Support\Facades\DB;
use App\Models\SituationMatrimoniale;

class Affectations extends Component
{
    //dans ce controller je vais developper la fonctionnalité historique
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    //variable pour la recherche et le filtre 
    public $search = "";
    public $filtreCommune = "";
    public $filtreSituaion = "";

    public function render()
    {
        $employeQuery = Employe::query();

        
        if($this->search != ""){
            $this->resetPage();
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
        $data = [
            "employes" => $employeQuery->latest()->paginate(5),
            "communeemployes" => Commune::orderBy("libelle","ASC")->get(),
            "situationemployes" => SituationMatrimoniale::orderBy("libelle","ASC")->get(),
            "pieceIdentites" => PieceIdentite::orderBy("libelle","ASC")->get(),
        ];
       
        // $affectations = DB::table('employe_service')
        // ->join('employes', 'employe_service.employe_id', '=', 'employes.id')
        // ->join('services', 'employe_service.service_id', '=', 'services.id')
        // ->join('departements', 'services.departement_id', '=', 'departements.id')
        // ->join('succursales', 'departements.succursale_id', '=', 'succursales.id')
        // ->select('employes.photo as photo','employes.matricule as matricule','employes.nom as nom','employes.prenom as prenom', 'succursales.libelle as succursale', 'departements.libelle as departement', 'services.libelle as service', 'employe_service.date_debut', 'employe_service.date_fin')
        // ->paginate(1);
        return view('livewire.affectations.index',$data)->extends("layouts.master")->section("contenu");
    }
}
