<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;
use App\Models\Departement;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class NosServices extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $departement_id = NULL;
    public $libelle = "";
    public $departements;
    public $editService = [];

    //Variables pour permettre l'affichage du bouton modifier
    public $editHasChanged = false;
    public $editServiceOldValues = [];

    public function showService(){
        $this->dispatchBrowserEvent("showAddModal");
    }
    public function closeModal(){
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
    public function editService($serviceId){
       $this->editService = Service::with("departement")->find($serviceId)->toArray();
       $this->editServiceOldValues = $this->editService;
       $this->dispatchBrowserEvent("showEditModal",[]);
    }
    public function fermerModal(){
        $this->dispatchBrowserEvent("closeModal");
    }

    public function fermerEditModal(){
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
    public function showUpadteButton(){
        $this->editHasChanged = false;
        if (
            $this->editService["libelle"] != $this->editServiceOldValues["libelle"] 
            
        ) {
            $this->editHasChanged  = true;
        }
    }
    //processus de delete Service 
    public function confirmDelete($name,$id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=>[
            'text' => "Vous êtes sur le point de supprimer la fonction $name de la liste.Voulez vous continuer?",
            'title' =>"Êtes vous sûr de vouloir continuer?",
            'type' => "warning",
            'data' => ["service_id" => $id]
        ]]);
    }
    public function deleteService(Service $service){
        $service->delete();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"La fonction $service->libelle supprimé avec succès!"]);
    }
    public function mount()
    {
       $this->departements = Departement::orderBy("libelle","ASC")->get();
        //$this->departementAll = collect();
    }
    public function render()
    {
        if ($this->editService != []) {
            $this->showUpadteButton();
        }
        $data = [
            "services" => Service::orderBy("libelle","ASC")->paginate(5),
        ];
        return view('livewire.nos_services.index',$data)->extends("layouts.master")->section("contenu");
    }
    
}
