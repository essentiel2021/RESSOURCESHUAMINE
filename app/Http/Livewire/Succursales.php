<?php

namespace App\Http\Livewire;

use App\Models\Succursale;
use Livewire\Component;
use Livewire\WithPagination;

class Succursales extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public function render()
    {
        $data = [
            "succursales" => Succursale::latest()->paginate(5)
        ];
        return view('livewire.succursales.index',$data)->extends("layouts.master")->section("contenu");
    }
}
