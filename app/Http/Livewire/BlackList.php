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
    public $search = "";
    public $editEmploye = [];
    public $editEmployeOldValues = [];

    public $editHasChanged;

    public function goToListEmployeeBlackList(){
        $this->currentPage = PAGELISTBLACKLIST;
    }

    public function goToEditEmployeeBlackList(Employe $employe){
        $this->currentPage = PAGEEDITFORMBLACKLIST;
        $this->editEmploye = $employe->toArray();
        $this->editEmployeOldValues = $this->editEmploye;
        $this->resetErrorBag();
        //dd($this->editEmployeOldValues);
    }
    public function editBlackList(){
        $employe = Employe::find($this->editEmploye["id"]);
        $employe->fill($this->editEmploye);
        $employe->save();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Employé modifié avec succès!"]);
    }
    public function showUpadteButton(){
        $this->editHasChanged = false;
        if ($this->editEmploye["blackList"] != $this->editEmployeOldValues["blackList"]
        ) {
            $this->editHasChanged  = true;
        }
    }
    public function render()
    {
        $employeQuery = Employe::query();

        if($this->search != ""){
            $employeQuery->where("nom", "LIKE",  "%". $this->search ."%")
                ->orWhere("matricule","LIKE",  "%". $this->search ."%")
                ->orWhere("prenom","LIKE",  "%". $this->search ."%");
        }
        if ($this->editEmploye != []) {
            $this->showUpadteButton();
        }
        $data = [
        "employes" => $employeQuery->where("blackList",1)->latest()->paginate(5),
        "communeemployes" => Commune::orderBy("libelle","ASC")->get(),
        "situationemployes" => SituationMatrimoniale::orderBy("libelle","ASC")->get(),
        "pieceIdentites" => PieceIdentite::orderBy("libelle","ASC")->get(),];
        return view('livewire.blackList.index',$data)->extends("layouts.master")->section("contenu");
    }
}
