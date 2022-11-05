<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;

class Services extends Component
{
    public function render()
    {
        $data = ["services" => Service::latest()->paginate(5)];
        return view('livewire.services.index',$data)->extends("layouts.master")->section("contenu");
    }
}
