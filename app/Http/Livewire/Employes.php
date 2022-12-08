<?php

namespace App\Http\Livewire;

use App\Models\Commune;
use App\Models\Employe;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PieceIdentite;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Models\SituationMatrimoniale;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Employes extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = "bootstrap";

    public $search = "";
    
    public $currentPage = PAGELISTEMPLOYE;
    public $filtreSituaion = "";
    public $filtreCommune = "";
    public $addPhoto = null;
    public $editPhoto = null;

    public $addPhotoPiece = null ;
    public $editPhotoPiece = null;

    public $addPhotoActe = null;
    public $editPhotoActe = null;

    public $newEmploye = [];
    public $editEmploye = [];

    public $editHasChanged = false;
    public $editEmployeOldValues = [];

    public function render()
    {
        $employeQuery = Employe::query();

         if($this->search != ""){
            $employeQuery->where("nom", "LIKE",  "%". $this->search ."%")
                    ->orWhere("matricule","LIKE",  "%". $this->search ."%")
                    ->orWhere("prenom","LIKE",  "%". $this->search ."%");
        }

        if($this->filtreCommune != ""){
            $employeQuery->where("commune_id",$this->filtreCommune);
        }
        if($this->filtreSituaion != ""){
            $employeQuery->where("situation_matrimoniale_id",$this->filtreSituaion);
        }
        
        $employeQuery->where("blackList",false);
        $data = [
            "employes" => $employeQuery->latest()->paginate(5),
            "communeemployes" => Commune::orderBy("libelle","ASC")->get(),
            "situationemployes" => SituationMatrimoniale::orderBy("libelle","ASC")->get(),
            "pieceIdentites" => PieceIdentite::orderBy("libelle","ASC")->get(),
        ];
        if ($this->editEmploye != []) {
            $this->showUpadteButton();
        }

        return view('livewire.employes.index',$data)->extends("layouts.master")->section("contenu");
    }
    protected $validationAttributes = [
        'newEmploye.nom' => 'Nom',
        'newEmploye.prenom' => 'Prénom',
        'newEmploye.situation_matrimoniale_id' => 'Situation matrimoniale',
        'newEmploye.commune_id' => 'Commune',
        'newEmploye.piece_identite_id' => 'Pièce d\'identité',
        'newEmploye.email' => 'Adrese mail',
        'newEmploye.sexe' => 'Sexe',
        'newEmploye.dateNaissance' => 'Date de Naissance',
        'newEmploye.nombre_enfant' => 'Nombre d\'enfante',
        'newEmploye.telephone1' =>'Téléphone',
        'newEmploye.telephone2' => 'Autre téléphone',
        'newEmploye.quatier' => 'Quatier',
        'newEmploye.personContact' => 'Personne à contacter',
        'newEmploye.personContactNum' => 'Numéro de la personne à contacter',
        'newEmploye.numeroIdentite' => 'Numero de la pièce d\'identité',
        'newEmploye.numeroPermis' => 'Numero de permis de conduire',
        'newEmploye.numeroCNPS' => 'Numero CNPS',
        'newEmploye.numeroDos' => 'Numero du dossier',
    ];
    public function rules(){
        if($this->currentPage == PAGEEDITFORMTEMPLOYE){
            return [
                'editEmploye.nom' => 'required',
                'editEmploye.prenom' => 'required',
                'editEmploye.situation_matrimoniale_id' => 'required',
                'editEmploye.commune_id' => 'required|exists:App\Models\Commune,id',
                'editEmploye.piece_identite_id' => 'required|exists:App\Models\PieceIdentite,id',
                'editEmploye.email' => ['required', 'email', Rule::unique("employes", "email")->ignore($this->editEmploye['id'])],
                'editEmploye.sexe' => 'required',
                'editEmploye.dateNaissance' => 'required',  
                'editEmploye.nombre_enfant' => 'required',
                'editEmploye.telephone1' =>['required', 'min:10', Rule::unique("employes", "telephone1")->ignore($this->editEmploye['id'])],
                'editEmploye.telephone2' => ['required', 'min:10', Rule::unique("employes", "telephone2")->ignore($this->editEmploye['id'])],
                'editEmploye.quatier' => 'required',
                'editEmploye.personContact' => 'required',
                'editEmploye.personContactNum' =>['required',Rule::unique("employes","personContactNum")->ignore($this->editEmploye['id'])], 
                'editEmploye.numeroIdentite' =>['required',Rule::unique("employes","numeroIdentite")->ignore($this->editEmploye['id'])],
                'editEmploye.numeroPermis' => ['nullable',Rule::unique("employes","numeroPermis")->ignore($this->editEmploye['id'])],
                'editEmploye.numeroCNPS' => ['nullable',Rule::unique("employes","numeroCNPS")->ignore($this->editEmploye['id'])],
                'editEmploye.numeroDos' => ['nullable','numeric',Rule::unique("employes","numeroDos")->ignore($this->editEmploye['id'])],
                // 'addPhoto' => 'image|max:10240',
                // 'addPhotoPiece' => 'image|max:10240',
                // 'addPhotoActe' => 'image|max:10240',
            ];
        }
        else {
            return [
                'newEmploye.nom' => 'required',
                'newEmploye.prenom' => 'required',
                'newEmploye.situation_matrimoniale_id' => 'required',
                'newEmploye.commune_id' => 'required|exists:App\Models\Commune,id',
                'newEmploye.piece_identite_id' => 'required|exists:App\Models\PieceIdentite,id',
                'newEmploye.email' => 'required|email|unique:employes,email',
                'newEmploye.sexe' => 'required',
                'newEmploye.dateNaissance' => 'required',  
                'newEmploye.nombre_enfant' => 'required',
                'newEmploye.telephone1' =>'required|unique:employes,telephone1|min:10',
                'newEmploye.telephone2' => 'required|unique:employes,telephone2|min:10',
                'newEmploye.quatier' => 'required',
                'newEmploye.personContact' => 'required',
                'newEmploye.personContactNum' => 'required|unique:employes,personContactNum',
                'newEmploye.numeroIdentite' => 'required|unique:employes,numeroIdentite',
                'newEmploye.numeroPermis' => 'nullable|unique:employes,numeroPermis',
                'newEmploye.numeroCNPS' => 'nullable|unique:employes,numeroCNPS',
                'newEmploye.numeroDos' => 'numeric|nullable|unique:employes,numeroDos',
                'addPhoto' => 'image|max:10240',
                'addPhotoPiece' => 'image|max:10240',
                'addPhotoActe' => 'image|max:10240',
            ];
        }
    }
    public function addEmployee(){
        $validateAttribute = $this->validate();
        $imagePath  = "images/imageplaceholder.png";
        $imagePieceIdentitePath = "images/imageplaceholder.png";
        $imageActeNaissancePath = "images/imageplaceholder.png";

        if($this->addPhoto != null){
            $path = $this->addPhoto->store('upload','public');
            $imagePath = "storage/".$path;
            $image = Image::make(public_path($imagePath))->fit(200,200);
            $image->save();
        }
        if($this->addPhotoPiece != null){
            $pathPieceIdentite = $this->addPhotoPiece->store('pieceIdentite','public');
            $imagePieceIdentitePath = "storage/".$pathPieceIdentite;
            $imagePieceIdentite = Image::make(public_path($imagePieceIdentitePath));
            $imagePieceIdentite->save();
        }

        if ($this->addPhotoActe != null) {
            $pathActeNaissance = $this->addPhotoPiece->store('acteNaissance','public');
            $imageActeNaissancePath = "storage/".$pathActeNaissance;
            $imageActeNaissance = Image::make($imageActeNaissancePath);
            $imageActeNaissance->save();
        }
        $validateAttribute['newEmploye']["matricule"] = matriculeGenerer();
        $validateAttribute['newEmploye']["photo"] = $imagePath;
        $validateAttribute['newEmploye']["photoPiece"] = $imagePieceIdentitePath;
        $validateAttribute['newEmploye']["acteNaissance"] = $imageActeNaissancePath;
        Employe::create($validateAttribute['newEmploye']);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Employé créé avec succès!"]);

        $this->newEmploye = [];
        $this->addPhoto = null;
        $this->addPhotoPiece = null;
        $this->addPhotoActe = null;
        
    }
    protected function cleanupOldUploads()
    {
        $storage = Storage::disk("local");
        foreach($storage->allFiles("livewire-tmp") as $pathFilleName){
            if(! $storage->exists($pathFilleName)) continue;
            $fiveSecondsDelete = now()->subSeconds(60)->timestamp;
            if($fiveSecondsDelete > $storage->lastModified($pathFilleName)){
                $storage->delete($pathFilleName);
            }
        }
    }
    public function editEmployee(){
        $this->validate();
        $employe = Employe::find($this->editEmploye["id"]);
        $employe->fill($this->editEmploye);
        if($this->editPhoto != null){
            $path = $this->editPhoto->store("upload", "public");
            $imagePath = "storage/".$path;
            $image = Image::make(public_path($imagePath))->fit(200, 200);
            $image->save();
            Storage::disk("local")->delete(str_replace("storage/", "public/upload", $employe->photo));
            $employe->photo = $imagePath;
        }
        if($this->editPhotoPiece != null){
            $pathPieceIdentite = $this->editPhotoPiece->store('pieceIdentite','public');
            $imagePieceIdentitePath = "storage/".$pathPieceIdentite;
            $imagePieceIdentite = Image::make(public_path($imagePieceIdentitePath));
            $imagePieceIdentite->save();
            Storage::disk("local")->delete(str_replace("storage/", "public/pieceIdentite", $employe->photoPiece));
            $employe->photoPiece = $imagePieceIdentitePath;
        }
        if ($this->editPhotoActe != null) {
            $pathActeNaissance = $this->editPhotoActe->store('acteNaissance','public');
            $imageActeNaissancePath = "storage/".$pathActeNaissance;
            $imageActeNaissance = Image::make($imageActeNaissancePath);
            $imageActeNaissance->save();
            Storage::disk("local")->delete(str_replace("storage/", "public/acteNaissance", $employe->acteNaissance));
            $employe->acteNaissance = $imageActeNaissancePath;
        }

        $employe->save();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Employé modifié avec succès!"]);

    }
  
    public function showUpadteButton(){
        $this->editHasChanged = false;
        if (
            $this->editEmploye["nom"] != $this->editEmployeOldValues["nom"] ||
            $this->editEmploye["prenom"] != $this->editEmployeOldValues["prenom"] ||
            $this->editEmploye["situation_matrimoniale_id"] != $this->editEmployeOldValues["situation_matrimoniale_id"] ||
            $this->editEmploye["commune_id"] != $this->editEmployeOldValues["commune_id"] ||
            $this->editEmploye["piece_identite_id"] != $this->editEmployeOldValues["piece_identite_id"] ||
            $this->editEmploye["dateNaissance"] != $this->editEmployeOldValues["dateNaissance"] ||
            $this->editEmploye["sexe"] != $this->editEmployeOldValues["sexe"] ||
            $this->editEmploye["nombre_enfant"] != $this->editEmployeOldValues["nombre_enfant"] ||
            $this->editEmploye["telephone1"] != $this->editEmployeOldValues["telephone1"] ||
            $this->editEmploye["telephone2"] != $this->editEmployeOldValues["telephone2"] ||
            $this->editEmploye["quatier"] != $this->editEmployeOldValues["quatier"] ||
            $this->editEmploye["numeroPermis"] != $this->editEmployeOldValues["numeroPermis"] ||
            $this->editEmploye["numeroIdentite"] != $this->editEmployeOldValues["numeroIdentite"] ||
            $this->editEmploye["numeroCNPS"] != $this->editEmployeOldValues["numeroCNPS"] ||
            $this->editEmploye["numeroDos"] != $this->editEmployeOldValues["numeroDos"] ||
            $this->editEmploye["personContact"] != $this->editEmployeOldValues["personContact"] ||
            $this->editEmploye["personContactNum"] != $this->editEmployeOldValues["personContactNum"] ||
            $this->editEmploye["email"] != $this->editEmployeOldValues["email"] ||
            $this->editEmploye["acteNaissance"] != $this->editEmployeOldValues["acteNaissance"] ||
            $this->editPhoto != null||
            $this->editPhotoPiece != null ||
            $this->editPhotoActe != null
        ) {
            $this->editHasChanged  = true;
        }
    }

    public function goToAddEmployee(){
        $this->currentPage = PAGECREATEFORMTEMPLOYE;
        $this->newEmploye = [];
        $this->addPhoto = null;
        $this->addPhotoPiece = null;
        $this->addPhotoActe = null;
        $this->resetErrorBag();
    }


    public function goToListEmployee(){
        $this->currentPage = PAGELISTEMPLOYE;
        $this->editEmploye = [];
        $this->editPhoto = null;
        $this->editPhotoPiece = null;
        $this->editPhotoActe = null;

    }

    public function goToEditEmployee(Employe $employe){
        $this->currentPage = PAGEEDITFORMTEMPLOYE;
        $this->editEmploye = $employe->toArray();
        $this->editEmployeOldValues = $this->editEmploye;
        $this->resetErrorBag();
    }
   
}
