<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Mutations extends Component
{
    public function render()
    {
        return view('livewire.mutations.list')->extends("layouts.master")->section("contenu");
    }
}
