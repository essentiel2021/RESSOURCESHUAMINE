<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use Illuminate\Validation\Rule;
use App\Models\Succursale;
use Livewire\Component;

class Departements extends Component
{
    public $succursales;
    //public $departementAll;
    public $succursale_id = NULL;
    public $libelle = "";
    public $editDepartement = [];

    //Variables pour permettre l'affichage du bouton modifier
    public $editHasChanged = false;
    public $editDepartementOldValues = [];

    protected $validationAttributes = [
        'succursale_id' => 'Succursale',
        'libelle' => 'Département',
    ];

    public function addDepartement(){
        $validateData = $this->validate([
            "libelle"  => 'required|unique:departements,libelle',
            "succursale_id"  => 'required',
        ]);
        Departement::create($validateData);
        $this->libelle = "";
        $this->succursale_id = NULL;
        $this->closeModal();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Compte créé avec succès!"]);
    }
    
    public function editDepartement($departementId){
        $this->editDepartement = Departement::with("succursale")->find($departementId)->toArray();
        $this->editDepartementOldValues = $this->editDepartement;
        $this->dispatchBrowserEvent("showEditModal",[]);
    }
    public function updateDepartement(){
        $this->validate([
            "editDepartement.libelle" => [
                "required",
                Rule::unique("departements", "libelle")->ignore($this->editDepartement["id"])
            ],
        ]);
        $departement = Departement::find($this->editDepartement["id"]);
        $departement->fill($this->editDepartement);
        $departement->save();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Département mise à jour avec succès!"]);
    }
    public function showDeleteDep($name,$id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=>[
            'text' => "Vous êtes sur le point de supprimer '$name' de la liste.Voulez vous continuer?",
            'title' =>"Êtes vous sûr de vouloir continuer?",
            'type' => "warning",
            'data' => ["departement_id" => $id]
        ]]);
    }
    public function deleteDepartement(Departement $departement){
        $departement->delete();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Département $departement->libelle supprimé avec succès!"]);
    }
    public function fermerModalEdit(){
        $this->dispatchBrowserEvent("closeEditModal");
        $this->resetErrorBag();
    }

    public function fermerModal(){
        $this->libelle = "";
        $this->succursale_id = NULL;
        $this->dispatchBrowserEvent("closeModal");
        $this->resetErrorBag();
    }
    
    public function showDepar(){
        $this->dispatchBrowserEvent("showAddModal");
    }
    public function closeModal(){
        $this->editDepartement = [];
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("closeModal",[]);
    }
    
    public function showUpadteButton(){
        $this->editHasChanged = false;
        if (
            $this->editDepartement["libelle"] != $this->editDepartementOldValues["libelle"] 
            
        ) {
            $this->editHasChanged  = true;
        }
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function mount()
    {
       $this->succursales = Succursale::orderBy("libelle","ASC")->get();
        //$this->departementAll = collect();
    }
    // public function updatedselectedSuccursale($succursale){
    //     $this->departementAll = Departement::where('succursale_id', $succursale)->get();
    // }

    public function render()
    {
        if ($this->editDepartement != []) {
            $this->showUpadteButton();
        }
        $data = [
            "departements" => Departement::latest()->paginate(5), 
        ];
        return view('livewire.departements.index',$data )->extends("layouts.master")->section("contenu");
    }
}
