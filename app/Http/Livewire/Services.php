<?php

namespace App\Http\Livewire;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class Services extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public function render()
    {
        $data = ["services" => Service::latest()->paginate(5)];
        return view('livewire.services.index',$data)->extends("layouts.master")->section("contenu");
    }
    public function confirmDelete(Service $service){

    }
    public function editService(Service $service){

    }
}
