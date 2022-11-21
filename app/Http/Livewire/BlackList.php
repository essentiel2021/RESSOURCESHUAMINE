<?php

namespace App\Http\Livewire;

use App\Models\Employe;
use Livewire\Component;
use Livewire\WithPagination;

class BlackList extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $search = "";
    public function render()
    {
        $employeQuery = Employe::query();

        if($this->search != ""){
            $employeQuery->where("nom", "LIKE",  "%". $this->search ."%")
                ->orWhere("matricule","LIKE",  "%". $this->search ."%")
                ->orWhere("prenom","LIKE",  "%". $this->search ."%");
        }
        $data = ["employes" => $employeQuery->where("blackList",1)->latest()->paginate(5),];
        return view('livewire.blackList.list',$data)->extends("layouts.master")->section("contenu");
    }
}
