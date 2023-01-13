<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;
use App\Models\Departement;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;



class ServiceComp extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $newService =[];
    public $editService = [];
    public $isService = false;
    public $idService ="";
    public $edit = false;
    public $departement;
    public function mount($id){
        
        $this->departement = Departement::find($id);
    }
    protected $validationAttributes = [
        'newService.libelle' => 'Nom de service',
    ];
    public function addService(){
        $this->isService = true;
    }

    public function editService(Service $service){
        $this->isService = true;
        $this->idService = $service->id;
        $this->edit = true;
        $this->editService = Service::find($service->id)->toArray();
    }

    public function saveService(){
        if(!$this->edit){
            $this->validate([
                "newService.libelle" => ["required","unique:services,libelle"]
            ]);
            Service::create([
                "libelle" => $this->newService["libelle"],
                "departement_id" => $this->departement->id
            ]);
        }
        else{
            $valider =$this->validate([
                "editService.libelle" => ["required", Rule::unique("services", "libelle")->ignore($this->editService["id"])]
            ]);
            
            Service::find($this->editService["id"])->update(["libelle"=>$valider["editService"]["libelle"]]);
        }
        $this->cancel();
    }
    public function cancel(){
        $this->isService = false;
        $this->resetErrorBag();
        $this->newService = [];
        $this->edit = false;
    }
    public function render()
    {
        $data = [
            "services" => Service::where("departement_id",$this->departement->id)->paginate(5),
        ];
        return view('livewire.services.index',$data)->extends("layouts.master")->section("contenu");
    }
}
