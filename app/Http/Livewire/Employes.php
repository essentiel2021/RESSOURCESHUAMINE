<?php

namespace App\Http\Livewire;

use App\Models\Commune;
use App\Models\Employe;
use App\Models\Service;
use Livewire\Component;
use App\Models\Succursale;
use App\Models\Departement;
use Livewire\WithPagination;
use App\Models\PieceIdentite;
use Livewire\WithFileUploads;
use App\Models\EmployeService;
use App\Models\Fonction;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\SituationMatrimoniale;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Employes extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = "bootstrap";
    //variables pour la recherche et filtre
    public $search = "";
    public $filtreSituaion = "";
    public $filtreCommune = "";
    public $filtreFonction = "";
 
    //variable pour l'apparition des pages
    public $currentPage = PAGELISTEMPLOYE;
   //variables pour les images
    public $addPhoto = null;
    public $editPhoto = null;
    public $addPhotoPiece = null ;
    public $editPhotoPiece = null;
    public $addPhotoActe = null;
    public $editPhotoActe = null;
    //variables tableau pour la creation ,modification et la suppression de l'employés
    public $newEmploye = [];
    public $editEmploye = [];
    public $deleteEmploye = [];

    //Variables pour permettre l'affichage du bouton modifier
    public $editHasChanged = false;
    public $editEmployeOldValues = [];

       //select dynamique 
       public $succursales;
       public $departements;
       public $services;
       public $selectedSuccursale = NULL;
       public $selectedDepartement = Null;

       //variables qui concerne l'affectation 
       public $newAffectation = [];
       public $newServiceId;
       public $employeId;
       public $editAffectation = [];

       //pour masquer le bouton affectation
       public $masquer = false;

    public function mount(){
        $this->succursales = Succursale::all(); 
        $this->departements = collect();
        $this->services = collect();
    }
    public function updatedselectedSuccursale($succursale){
        if (!is_null($succursale)) {
            $this->departements = Departement::where('succursale_id', $succursale)->get();
        }
    }
    
    public function updatedselectedDepartement($departement){
        if (!is_null($departement)) {
            $this->services = Service::where("departement_id",$departement)->get();
        }
    }

    public function render()
    {
        $employeQuery = Employe::query();

         if($this->search != ""){
            $this->resetPage();
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
        if ($this->filtreFonction != "") {
            $employeQuery->where("fonction_id",$this->filtreFonction);
        }
        
        $employeQuery->where("blackList",false);
        $data = [
            "employes" => $employeQuery->latest()->paginate(5),
            "communeemployes" => Commune::orderBy("libelle","ASC")->get(),
            "situationemployes" => SituationMatrimoniale::orderBy("libelle","ASC")->get(),
            "pieceIdentites" => PieceIdentite::orderBy("libelle","ASC")->get(),
            "fonctions" => Fonction::orderBy("libelle","ASC")->get(),
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
        'newEmploye.fonction_id' => 'Fonction',
        'newEmploye.lieu_naissance' => 'Lieu de naissance',
    ];
    public function rules(){
        if($this->currentPage == PAGEEDITFORMTEMPLOYE){
            return [
                'editEmploye.nom' => 'required',
                'editEmploye.prenom' => 'required',
                'editEmploye.situation_matrimoniale_id' => 'required',
                'editEmploye.commune_id' => 'required|exists:App\Models\Commune,id',
                'editEmploye.piece_identite_id' => 'required|exists:App\Models\PieceIdentite,id',
                'editEmploye.email' => ['email', Rule::unique("employes", "email")->ignore($this->editEmploye['id'])],
                'editEmploye.sexe' => 'required',
                'editEmploye.dateNaissance' => 'required',  
                'editEmploye.nombre_enfant' => 'required',
                'editEmploye.telephone1' =>['required', 'min:10', Rule::unique("employes", "telephone1")->ignore($this->editEmploye['id'])],
                // 'editEmploye.telephone2' => ['required', 'min:10', Rule::unique("employes", "telephone2")->ignore($this->editEmploye['id'])],
                'editEmploye.quatier' => 'required',
                'editEmploye.personContact' => 'required',
                'editEmploye.personContactNum' =>['required',Rule::unique("employes","personContactNum")->ignore($this->editEmploye['id'])], 
                'editEmploye.numeroIdentite' =>['required',Rule::unique("employes","numeroIdentite")->ignore($this->editEmploye['id'])],
                'editEmploye.numeroPermis' => ['nullable',Rule::unique("employes","numeroPermis")->ignore($this->editEmploye['id'])],
                'editEmploye.numeroCNPS' => ['nullable',Rule::unique("employes","numeroCNPS")->ignore($this->editEmploye['id'])],
                'editEmploye.numeroDos' => ['nullable','numeric',Rule::unique("employes","numeroDos")->ignore($this->editEmploye['id'])],
            ];
        }
        else {
            return [
                'newEmploye.nom' => 'required',
                'newEmploye.prenom' => 'required',
                'newEmploye.situation_matrimoniale_id' => 'required',
                'newEmploye.commune_id' => 'required|exists:App\Models\Commune,id',
                'newEmploye.piece_identite_id' => 'required|exists:App\Models\PieceIdentite,id',
                'newEmploye.email' => 'email|unique:employes,email',
                'newEmploye.sexe' => 'required',
                'newEmploye.dateNaissance' => 'required',  
                'newEmploye.nombre_enfant' => 'required',
                'newEmploye.telephone1' =>'required|unique:employes,telephone1|min:10',
                'newEmploye.telephone2' => 'unique:employes,telephone2|min:10',
                'newEmploye.quatier' => 'required',
                'newEmploye.personContact' => 'required',
                'newEmploye.personContactNum' => 'required|unique:employes,personContactNum',
                'newEmploye.numeroIdentite' => 'required|unique:employes,numeroIdentite',
                'newEmploye.numeroPermis' => 'nullable|unique:employes,numeroPermis',
                'newEmploye.numeroCNPS' => 'nullable|unique:employes,numeroCNPS',
                'newEmploye.numeroDos' => 'numeric|nullable|unique:employes,numeroDos',
                'newEmploye.fonction_id' =>['sometimes','nullable','exists:fonctions,id'],
                'newEmploye.lieu_naissance' => 'required'
                // 'addPhoto' => 'image|max:10240',
                // 'addPhotoPiece' => 'image|max:10240',
                // 'addPhotoActe' => 'image|max:10240',
            ];
        }
    }
    public function addEmployee(){
        $user = auth()->user();
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
        $validateAttribute['newEmploye']["user_id"] = $user->id;
        //dd($validateAttribute['newEmploye']);
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
        //User::find($this->editUser["id"])->update($validateAttribute["editUser"]);
        $this->validate();
        $employe = Employe::find($this->editEmploye["id"]);
        $user = auth()->user();
        $this->editEmploye["user_id"] = $user->id;
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
    public function showDeleteEmploye(Employe $employe){

        $this->dispatchBrowserEvent("showConfirmMessage", ["message"=> [
            "text" => "Vous êtes sur le point de supprimer ". $employe->nom ." " . $employe->prenom ." de la liste des employés. Voulez-vous continuer?",
            "title" => "Êtes-vous sûr de continuer?",
            "type" => "warning",
            "data" => [
                "employe_id" => $employe->id
            ]
        ]]);
    }
    public function supprimerEmploye(Employe $employe){
        $employe->user_id = auth()->user()->id;
        $employe->save();
        $employe->delete();
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"L'employé". $employe->nom ." " . $employe->prenom ."supprimé avec succès!"]);
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
            $this->editEmploye["fonction_id"] != $this->editEmployeOldValues["fonction_id"] ||
            $this->editEmploye["lieu_naissance"] != $this->editEmployeOldValues["lieu_naissance"] ||
            $this->editPhoto != null||
            $this->editPhotoPiece != null ||
            $this->editPhotoActe != null ||
            $this->editEmploye["blackList"] != $this->editEmployeOldValues["blackList"]
        ) {
            $this->editHasChanged  = true;
        }
    }
    public function showAddAffectation($employeId){
        $this->dispatchBrowserEvent("showAddModal");
        $this->employeId = $employeId;
    }
    public function addAffectation(){
        //verification les champs date_debut et nombre de mois qui doivent etre requise
        $validateAttribute = $this->validate([
            "newAffectation.date_debut" => ["required"],
            "newAffectation.nombre_mois" => ["required"],
            // "newAffectation.date_fin" => ["required"],
        ]);
        //ici je fais l'operation pour calculer la date de fin 
        $startDate = Carbon::parse($validateAttribute['newAffectation']["date_debut"]);
        $months = $validateAttribute['newAffectation']["nombre_mois"];
        $endDate = $startDate->copy()->addMonths($months);
        //fin du calcule de date de fin

        //con
        $exists = DB::table('employe_service')
            ->where('employe_id', $this->employeId)
            ->where('is_end', false)
            ->exists();
        //ici on fait une verification dans le if et quand c'est 
        //bon on récupere le premier enregistrement et on mets le champ is_end à true
        if ($exists) {
            $service = DB::table('employe_service')
            ->where('employe_id', $this->employeId)
            ->where('is_end',false)
            ->first();
            
            DB::table('employe_service')
            ->where('id', $service->id)
            ->update(['is_end' => true]);
        }
        //ici il est question d'enregistrer l'affectation dans la DB
        $validateAttribute['newAffectation']["employe_id"] = $this->employeId;
        $validateAttribute['newAffectation']["service_id"] = $this->newServiceId;
        $validateAttribute['newAffectation']['date_fin'] = $endDate->format('Y-m-d');
        EmployeService::create($validateAttribute['newAffectation']);
        $this->dispatchBrowserEvent("showSuccessMessage", ["message"=>"Affecter avec succès!"]);
    }
    public function closeAddAffectationModal(){
        $this->resetErrorBag();
        $this->selectedSuccursale = NULL;
        $this->selectedDepartement = Null;
        $this->newAffectation = [];
        $this->newServiceId = null;
        $this->dispatchBrowserEvent("closeModal",[]);
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