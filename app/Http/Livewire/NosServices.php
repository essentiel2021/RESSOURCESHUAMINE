<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;
use App\Models\Departement;
use Illuminate\Validation\Rule;

class NosServices extends Component
{
    public $departement_id = NULL;
    public $libelle = "";
    public $departements;
    public $editService = [];

    public function showService(){
        $this->dispatchBrowserEvent("showAddModal");
    }
    public function closeModal(){
        $this->resetErrorBag();
        $this->libelle = "";
        $this->departement_id = NULL;
        $this->dispatchBrowserEvent("closeModal",[]);
    }
    public function addService(){
        $validateData = $this->validate([
            "libelle"  => 'required|unique:services,libelle',
            "departement_id"  => 'required',
        ]);
        Service::create($validateData);
        $this->closeModal();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Service créé avec succès!"]);
    }
    public function editService(Service $service){
       $this->editService["libelle"] = $service->libelle;
       $this->editService["id"] = $service->id;
       $this->dispatchBrowserEvent("showEditModal",[]);
    }
    public function fermerModal(){
        $this->dispatchBrowserEvent("closeEditModal");
    }
    public function updateService(){
        $this->validate([
            "editService.libelle" => [
                "required",
                Rule::unique("services", "libelle")->ignore($this->editService["id"])
            ],
        ]);
        Service::find($this->editService["id"])->update([
            "libelle" => $this->editService["libelle"]
        ]);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Service mise à jour avec succès!"]);
        $this->fermerModal();
    }
    public function mount()
    {
       $this->departements = Departement::orderBy("libelle","ASC")->get();
        //$this->departementAll = collect();
    }
    public function render()
    {
        $data = [
            "services" => Service::orderBy("libelle","ASC")->paginate(5),
        ];
        return view('livewire.nos_services.index',$data)->extends("layouts.master")->section("contenu");
    }
    
}
