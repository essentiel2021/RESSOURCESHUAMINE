<?php

namespace App\Http\Livewire;

use App\Models\Employe;
use Livewire\Component;
use Livewire\WithPagination;

class Employes extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $search = "";
    
    public $currentPage = PAGELISTEMPLOYE;
    public function render()
    {
        $employeQuery = Employe::query();
        $employeQuery->where("nom", "LIKE",  "%". $this->search ."%")
                    ->orWhere("matricule","LIKE",  "%". $this->search ."%")
                    ->orWhere("prenom","LIKE",  "%". $this->search ."%");

        $data = ["employes" => $employeQuery->latest()->paginate(5)];
        return view('livewire.employes.index',$data)->extends("layouts.master")->section("contenu");
    }

    public function goToAddEmployee(){
        $this->currentPage = PAGECREATEFORMTEMPLOYE;
    }

    public function goToListEmployee(){
        $this->currentPage = PAGELISTEMPLOYE;
    }

    public function goToEditEmployee(){
        $this->currentPage = PAGEEDITFORMTEMPLOYE;
    }
   
}
