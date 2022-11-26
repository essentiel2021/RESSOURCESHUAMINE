<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;

class NosServices extends Component
{
    public $departement_id = NULL;
    public $libelle = "";

    public function showService(){
        $this->dispatchBrowserEvent("showAddModal");
    }
    public function closeModal(){
        $this->resetErrorBag();
        $this->dispatchBrowserEvent("closeModal",[]);
    }
    public function addService(){
        
    }
    public function render()
    {
        $data = [
            "services" => Service::orderBy("libelle","ASC")->paginate(5),
        ];
        return view('livewire.nos_services.index',$data)->extends("layouts.master")->section("contenu");
    }
    
}
