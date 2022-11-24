<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use App\Models\Succursale;
use Livewire\Component;

class Departements extends Component
{
    public $succursales;
    //public $departementAll;
    public $succursale_id = NULL;
    public $libelle = "";
    public $editDepartement = [];
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
        $this->closeModal();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Compte créé avec succès!"]);
    }
    public function updateDepartement(){

    }
    public function editDepartement(Departement $departement){
        $this->editDepartement["libelle"] = $departement->libelle;
        $this->editDepartement["id"] = $departement->id;
        $this->dispatchBrowserEvent("showEditModal",[]);
    }
    public function closeEditModal(){
        $this->editDepartement = [];
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("closeEditModal", []);
    }
    
    public function showDepar(){
        $this->dispatchBrowserEvent("showAddModal");
    }
    public function closeModal(){
        $this->selectedSuccursale = NULL;
        $this->nameDepartement = "";
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("closeModal",[]);
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
        $data = [
            "departements" => Departement::latest()->paginate(5), 
        ];
        return view('livewire.departements.index',$data )->extends("layouts.master")->section("contenu");
    }
}
