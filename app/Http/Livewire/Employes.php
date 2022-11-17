<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class Employes extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    
    public $currentPage = PAGELISTEMPLOYE;
    public function render()
    {
        return view('livewire.employes.index')->extends("layouts.master")->section("contenu");
    }
}
