<?php

namespace App\Http\Livewire;

use App\Models\Commune;
use App\Models\Employe;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PieceIdentite;
use Illuminate\Validation\Rule;
use App\Models\SituationMatrimoniale;

class BlackList extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $currentPage = PAGELISTBLACKLIST;

    public function rules(){
        if($this->currentPage == PAGEEDITFORMBLACKLIST){
            return [
                'editEmploye.nom' => 'required',
                'editEmploye.prenom' => 'required',
                'editEmploye.situation_matrimoniale_id' => 'required',
                'editEmploye.commune_id' => 'required|exists:App\Models\Commune,id',
                'editEmploye.piece_identite_id' => 'required|exists:App\Models\PieceIdentite,id',
                'editEmploye.email' => ['required', 'email', Rule::unique("employes", "email")->ignore($this->editEmploye['id'])],
                'editEmploye.sexe' => 'required',
                'editEmploye.dateNaissance' => 'required',  
                'editEmploye.nombre_enfant' => 'required',
                'editEmploye.telephone1' =>['required', 'min:10', Rule::unique("employes", "telephone1")->ignore($this->editEmploye['id'])],
                'editEmploye.telephone2' => ['required', 'min:10', Rule::unique("employes", "telephone2")->ignore($this->editEmploye['id'])],
                'editEmploye.quatier' => 'required',
                'editEmploye.personContact' => 'required',
                'editEmploye.personContactNum' =>['required',Rule::unique("employes","personContactNum")->ignore($this->editEmploye['id'])], 
                'editEmploye.numeroIdentite' =>['required',Rule::unique("employes","numeroIdentite")->ignore($this->editEmploye['id'])],
                'editEmploye.numeroPermis' => ['nullable',Rule::unique("employes","numeroPermis")->ignore($this->editEmploye['id'])],
                'editEmploye.numeroCNPS' => ['nullable',Rule::unique("employes","numeroCNPS")->ignore($this->editEmploye['id'])],
                'editEmploye.numeroDos' => ['nullable','numeric',Rule::unique("employes","numeroDos")->ignore($this->editEmploye['id'])],
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
                'newEmploye.numeroPermis' => 'nullable|unique:employes,numeroPermis',
                'newEmploye.numeroCNPS' => 'nullable|unique:employes,numeroCNPS',
                'newEmploye.numeroDos' => 'numeric|nullable|unique:employes,numeroDos',
            ];
        }
    }

    public $search = "";
    public $editEmploye = [];
    public function goToListEmployeeBlackList(){
        $this->currentPage = PAGELISTBLACKLIST;
    }

    public function goToEditEmployeeBlackList(Employe $employe){
        $this->currentPage = PAGEEDITFORMBLACKLIST;
        $this->editEmploye = $employe->toArray();
        //dd($this->editEmploye);
        $this->resetErrorBag();
    }
    public function editBlackList(){
        $validateAttribute = $this->validate();
        $validateAttribute['editEmploye']["blackList"] = $this->editEmploye["blackList"];
        //dd($validateAttribute);
        Employe::find($this->editEmploye["id"])->update($validateAttribute["editEmploye"]);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Employé modifié avec succès!"]);
    }
    public function render()
    {
        $employeQuery = Employe::query();

        if($this->search != ""){
            $employeQuery->where("nom", "LIKE",  "%". $this->search ."%")
                ->orWhere("matricule","LIKE",  "%". $this->search ."%")
                ->orWhere("prenom","LIKE",  "%". $this->search ."%");
        }
        $data = [
        "employes" => $employeQuery->where("blackList",1)->latest()->paginate(5),
        "communeemployes" => Commune::orderBy("libelle","ASC")->get(),
        "situationemployes" => SituationMatrimoniale::orderBy("libelle","ASC")->get(),
        "pieceIdentites" => PieceIdentite::orderBy("libelle","ASC")->get(),
    ];
        return view('livewire.blackList.index',$data)->extends("layouts.master")->section("contenu");
    }
}
