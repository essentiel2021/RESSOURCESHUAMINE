<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use App\Models\Succursale;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class Succursales extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $isAddSuccursale = false;
    public $newSuccursaleName = "";
    public $newValue = "";
    public $selectedSuccursale;
    public $newDepartement = "";

    public function toggleShowAddSuccursaleForm(){
        if($this->isAddSuccursale){
            $this->isAddSuccursale = false;
            $this->newSuccursaleName = "";
            $this->resetErrorBag();
        }
        else{
            $this->isAddSuccursale = true;
        }
    }
    protected $validationAttributes = [
        'newSuccursaleName' => 'Succursale'
    ];
    public function addNewSuccursale(){
        $validated = $this->validate([
            "newSuccursaleName.libelle" => "required|max:50|unique:succursales,libelle"
        ]);
        Succursale::create(["libelle"=> $validated["newSuccursaleName"]]);

        $this->toggleShowAddSuccursaleForm();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Succursale ajoutée  avec succès!"]);
    }
    public function editSuccursale(Succursale $succursale){
        //renvoi lobjet succursale
        $this->dispatchBrowserEvent("showEditForm",["succursale"=>$succursale]);
    }
    public function updateSuccursale( Succursale $succursale,$valueFromJs){
        $this->newValue = $valueFromJs;
        $validated = $this->validate([
            "newValue" => ["required", "max:50", Rule::unique("succursales", "libelle")->ignore($succursale->id)]
        ]);
        $succursale->update(["libelle" => $validated["newValue"]]);
        $this->dispatchBrowserEvent("showSuccessMessage",["message" => "Succursale mise à jour avec succès !"]);
    }
    public function confirmDelete($name,$id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=>[
            'text' => "Vous êtes sur le point de supprimer la succursale $name de la liste.Voulez vous continuer?",
            'title' =>"Êtes vous sûr de vouloir continuer?",
            'type' => "warning",
            'data' => ["succursale_id" => $id]
        ]]);
    }
    public function deleteSuccursale(Succursale $succursale){
        $succursale->delete();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Succursale $succursale->libelle supprimé avec succès!"]);
    }
    public function showProp(Succursale $succursale){
        //dd($succursale);
        $this->selectedSuccursale = $succursale;
        $this->dispatchBrowserEvent("showModal",[]);
    }
    public function closeModal(){
        $this->dispatchBrowserEvent("closeModal",[]);
    }

    public function addDepartement(){
        $validated = $this->validate([
            "newDepartement" => ["required",Rule::unique("departements", "libelle")->where("succursale_id", $this->selectedTypeArticle->id)]
        ]);
        Departement::create([
            "libelle" => $this->newDepartement,
            "succursale_id" => $this->selectedSuccursale->id
        ]);
    }

    public function render()
    {
        $data = [
            "succursales" => Succursale::latest()->paginate(5),
            "departements" => Departement::where("succursale_id",optional($this->selectedSuccursale)->id)->get()
        ];
        return view('livewire.succursales.index',$data)->extends("layouts.master")->section("contenu");
    }
    
}
