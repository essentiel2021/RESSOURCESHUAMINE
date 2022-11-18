<?php

namespace App\Http\Livewire;

use App\Models\Employe;
use Livewire\Component;
use Livewire\WithPagination;

class Employes extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    
    public $currentPage = PAGELISTEMPLOYE;

    public function goToAddEmployee(){
        $this->currentPage = PAGECREATEFORMTEMPLOYE;
    }

    public function goToListEmployee(){
        $this->currentPage = PAGELISTEMPLOYE;
    }

    public function goToEditEmployee(){
        $this->currentPage = PAGEEDITFORMTEMPLOYE;
    }
    public function render()
    {
        $data = ["employes" => Employe::latest()->paginate(5)];
        return view('livewire.employes.index',$data)->extends("layouts.master")->section("contenu");
    }
}
