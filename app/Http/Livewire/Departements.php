<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use App\Models\Succursale;
use Livewire\Component;

class Departements extends Component
{
    public $succursales;
    //public $departementAll;
    public $selectedSuccursale = NULL;
    public $nameDepartement = "";

    public function showDepar(){
        $this->dispatchBrowserEvent("showAddModal");
    }
    public function closeModal(){
        $this->selectedSuccursale = NULL;
        $this->nameDepartement = "";
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
