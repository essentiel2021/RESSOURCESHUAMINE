<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class Services extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $newService = [];
    public $editService =[];
    public function render()
    {
        $data = [
            "services" => Service::latest()->paginate(5),
            "departements" => Departement::orderBy("libelle","ASC")->get()
        ];
        return view('livewire.services.index',$data)->extends("layouts.master")->section("contenu");
    }
    public function confirmDelete(Service $service){

        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=>[
            'text' => "Vous êtes sur le point de supprimer le service $service->libelle de la liste.Voulez vous continuer?",
            'title' =>"Êtes vous sûr de vouloir continuer?",
            'type' => "warning",
            'data' => ["service_id" => $service->id]
        ]]);

    }
    
    public function editService(Service $service){
        $this->editService["libelle"] = $service->libelle;
        $this->editService["departement"] = $service->departement_id;
        $this->showEditServiceModal();
    }
    public function closeEditModal(){
        
    }
    public function showEditServiceModal(){
        $this->dispatchBrowserEvent("showEditModal",[]);
    }
    public function showAddServiceModal(){
        $this->dispatchBrowserEvent("showModal",[]);
    }
    public function closeModal(){
        $this->dispatchBrowserEvent("closeModal",[]);
        $this->newService = [];
    }
    public function addServices(){

        $validated = $this->validate([
            "newService.libelle" => ["required"],
            "newService.departement" => ["required"]
        ]);
        Service::create([
            "libelle" => $validated["newService"]["libelle"],
            "departement_id" => $validated["newService"]["departement"]
        ]);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Service ajoutée avec succès!"]);
        $this->resetErrorBag();
        $this->newService = [];
        $this->closeModal();
    }
}
