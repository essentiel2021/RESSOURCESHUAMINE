<?php

namespace App\Http\Livewire;

use App\Models\Succursale;
use Livewire\Component;
use Livewire\WithPagination;

class Succursales extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $isAddSuccursale = false;
    public $newSuccursaleName = "";

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
            "newSuccursaleName" => "required|max:50|unique:succursales,libelle"
        ]);
        Succursale::create(["libelle"=> $validated["newSuccursaleName"]]);

        $this->toggleShowAddSuccursaleForm();
        // $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Type d'article ajouté à jour avec succès!"]);
    }
    public function editSuccursale($id){
        $succursale = Succursale::find($id); 
        //dd($succursale->exists);
        //renvoi lobjet succursale
        $this->dispatchBrowserEvent("showEditForm",["succursale"=>$succursale]);
    }
    public function updateSuccursale(){

    }
    public function render()
    {
        $data = [
            "succursales" => Succursale::latest()->paginate(5)
        ];
        return view('livewire.succursales.index',$data)->extends("layouts.master")->section("contenu");
    }
    
}
