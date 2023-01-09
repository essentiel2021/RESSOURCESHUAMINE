<?php

namespace App\Http\Livewire;

use App\Models\Employe;
use App\Models\Service;
use Livewire\Component;
use App\Models\Succursale;
use App\Models\Departement;
use App\Models\EmployeService;
use Livewire\WithPagination;

class Affectations extends Component
{
    //dans ce controller je vais developper la fonctionnalité historique
    use WithPagination;
    protected $paginationTheme = "bootstrap";

      //select dynamique 
      public $succursales;
      public $departements;
      public $services;
      public $selectedSuccursale = NULL;
      public $selectedDepartement = Null;
      public $employeId;
      //variables qui concerne l'affectation 
      public $newAffectation = [];
      public $modifAffectation = [];

    public function showAffectation($employeId){
        $this->employeId = $employeId;
        $this->dispatchBrowserEvent("showAddModal");
    }

    public function closeAddAffectationModal(){
        $this->resetErrorBag();
        $this->selectedSuccursale = NULL;
        $this->selectedDepartement = Null;
        $this->newAffectation = [];
        $this->dispatchBrowserEvent("closeModal",[]);
    }
    public function editAffectation($employeId){
        $employeService = EmployeService::where('is_end', false)
        ->where('employe_id', $employeId)
        ->with("employe")
        ->with("service")
        ->first();
        if (!is_null($employeService)) {
            $this->modifAffectation =  $employeService->toArray();
        }
        $this->dispatchBrowserEvent("showEditModal");
    }
    public function addAffectation(){
        $validateAttribute = $this->validate([
            "newAffectation.date_debut" => ["required"],
            "newAffectation.date_fin" => ["required"],
        ]);
        $validateAttribute['newAffectation']["employe_id"] = $this->employeId;
        $validateAttribute['newAffectation']["service_id"] =$this->newAffectation["service_id"];
        EmployeService::create($validateAttribute['newAffectation']);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Affecter avec succès!"]);
    }
   
  public function mount(){
      $this->succursales = Succursale::all();
      $this->departements = collect();
      $this->services = collect();
  }
  public function updatedselectedSuccursale($succursale){
    if (!is_null($succursale)) {
        $this->departements = Departement::where('succursale_id', $succursale)->get();
    }
  }
  
  public function updatedselectedDepartement($departement){
    if (!is_null($departement)) {
        $this->services = Service::where("departement_id",$departement)->get();
    }
  }
    public function render()
    {
        $data = [
            "employes" => Employe::latest()->paginate(5),
        ];
        return view('livewire.affectations.index',$data)->extends("layouts.master")->section("contenu");
    }
}
