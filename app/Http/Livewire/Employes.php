<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Employes extends Component
{
    public $currentPage = PAGELISTEMPLOYE;
    public function render()
    {
        return view('livewire.employes.index')->extends("layouts.master")->section("contenu");
    }
}
