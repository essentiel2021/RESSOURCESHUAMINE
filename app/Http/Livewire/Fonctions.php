<?php

namespace App\Http\Livewire;

use App\Models\Fonction;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Fonctions extends Component
{
    public $libelle = "";
    public $editLibelle = [];

    //Variables pour permettre l'affichage du bouton modifier
    public $editHasChanged = false;
    public $editFonctionOldValues = [];

    //procesus de création de fonction
    public function showFonction(){
        $this->dispatchBrowserEvent("showAddModal");
    }
    public function closeModal(){
        $this->dispatchBrowserEvent("closeModal");
        $this->resetErrorBag();
        $this->libelle = [];
    }

    public function addFonction(){
        $validateData = $this->validate([
            "libelle"  => 'required|unique:fonctions,libelle',
        ]);
        Fonction::create($validateData);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Fonction créé avec succès!"]);
        $this->libelle = "";
    }
    //procesus de modification
    public function editFonction($fonctionId){
        $this->editLibelle = Fonction::find($fonctionId)->toArray();
        $this->editFonctionOldValues = $this->editLibelle;
        $this->showModif();
    }
    public  function showModif(){
        $this->dispatchBrowserEvent("showEditModal");
    }
    public function closeModalEdit(){
        $this->dispatchBrowserEvent("closeEditModal");
    }
    public function updateFonction(){
        $this->validate([
            "editLibelle.libelle" => [
                "required",
                Rule::unique("fonctions", "libelle")->ignore($this->editLibelle["id"])
            ],
        ]);
        Fonction::find($this->editLibelle["id"])->update([
            "libelle" => $this->editLibelle["libelle"]
        ]);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Fonction mise à jour avec succès!"]);
    }
    public function showUpadteButton(){
        $this->editHasChanged = false;
        if (
            $this->editLibelle["libelle"] != $this->editFonctionOldValues["libelle"] 
            
        ) {
            $this->editHasChanged  = true;
        }
    }
    // procesus de delete 
    public function confirmDelete($name,$id){
        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=>[
            'text' => "Vous êtes sur le point de supprimer la fonction $name de la liste.Voulez vous continuer?",
            'title' =>"Êtes vous sûr de vouloir continuer?",
            'type' => "warning",
            'data' => ["fonction_id" => $id]
        ]]);
    }
    public function deleteFonction(Fonction $fonction){
        $fonction->delete();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"La fonction $fonction->libelle supprimé avec succès!"]);
    }
    public function render()
    {
        if ($this->editLibelle != []) {
            $this->showUpadteButton();
        }
        $data = [
            "fonctions" => Fonction::orderBy("libelle","ASC")->paginate(5),
        ];

        return view('livewire.fonctions.index',$data)->extends("layouts.master")->section("contenu");
    }
}
