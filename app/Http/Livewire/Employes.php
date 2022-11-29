<?php

namespace App\Http\Livewire;

use App\Models\Commune;
use App\Models\Employe;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PieceIdentite;
use Illuminate\Validation\Rule;
use App\Models\SituationMatrimoniale;

class Employes extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $search = "";
    
    public $currentPage = PAGELISTEMPLOYE;
    public $filtreSituaion = "";
    public $filtreCommune = "";
    public $filtreblack = "";

    public $newEmploye = [];
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
            "pieceIdentites" => PieceIdentite::orderBy("libelle","ASC")->get(),
        ];

        return view('livewire.employes.index',$data)->extends("layouts.master")->section("contenu");
    }
    protected $validationAttributes = [
        'newEmploye.nom' => 'Nom',
        'newEmploye.prenom' => 'Prénom',
        'newEmploye.situation_matrimoniale_id' => 'Situation matrimoniale',
        'newEmploye.commune_id' => 'Commune',
        'newEmploye.piece_identite_id' => 'Pièce d\'identité',
        'newEmploye.email' => 'Adrese mail',
        'newEmploye.sexe' => 'Sexe',
        'newEmploye.dateNaissance' => 'Date de Naissance',
        'newEmploye.nombre_enfant' => 'Nombre d\'enfante',
        'newEmploye.telephone1' =>'Téléphone',
        'newEmploye.telephone2' => 'Autre téléphone',
        'newEmploye.quatier' => 'Quatier',
        'newEmploye.personContact' => 'Personne à contacter',
        'newEmploye.personContactNum' => 'Numéro de la personne à contacter',
        'newEmploye.numeroIdentite' => 'Numero de la pièce d\'identité',
        'newEmploye.numeroPermis' => 'Numero de permis de conduire',
        'newEmploye.numeroCNPS' => 'Numero CNPS',
        'newEmploye.numeroDos' => 'Numero du dossier',

    ];
    public function rules(){
        if($this->currentPage == PAGEEDITFORMTEMPLOYE){
            return [
               
            ];
        }
        else {
            return [
                'newEmploye.nom' => 'required',
                'newEmploye.prenom' => 'required',
                'newEmploye.situation_matrimoniale_id' => 'required',
                'newEmploye.commune_id' => 'required|exists:App\Models\Commune,id',
                'newEmploye.piece_identite_id' => 'required|exists:App\Models\PieceIdentite,id',
                'newEmploye.email' => 'required|email|unique:employes,email',
                'newEmploye.sexe' => 'required',
                'newEmploye.dateNaissance' => 'required',  
                'newEmploye.nombre_enfant' => 'required',
                'newEmploye.telephone1' =>'required|unique:employes,telephone1|min:10',
                'newEmploye.telephone2' => 'required|unique:employes,telephone2|min:10',
                'newEmploye.quatier' => 'required',
                'newEmploye.personContact' => 'required',
                'newEmploye.personContactNum' => 'required|unique:employes,personContactNum',
                'newEmploye.numeroIdentite' => 'required|unique:employes,numeroIdentite',
                'newEmploye.numeroPermis' => 'required|unique:employes,numeroPermis',
                'newEmploye.numeroCNPS' => 'unique:employes,numeroCNPS',
                'newEmploye.numeroDos' => 'unique:employes,numeroDos',
            ];
        }
    }
    public function addEmployee(){
        $validateAttribute = $this->validate();
        //dd($validateAttribute['newEmploye']);
        Employe::create($validateAttribute['newEmploye']);
        // User::create($validateAttribute['newUser']);
        // $this->newUser = [];
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Compte créé avec succès!"]);
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
