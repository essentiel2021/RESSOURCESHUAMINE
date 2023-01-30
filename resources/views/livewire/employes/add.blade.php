<form role="form" wire:submit.prevent="addEmployee()">
    <div class="row p-4 pt-5">
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i></h3>
                </div>
                <div>
                <div class="card-body">
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Nom</label>
                            <input type="text" id="newEmploye.nom" wire:model="newEmploye.nom" class="form-control @error('newEmploye.nom') is-invalid @enderror" placeholder="Nom de l'employé">
                            @error("newEmploye.nom")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Prénom</label>
                            <input type="text" wire:model='newEmploye.prenom' class="form-control @error('newEmploye.prenom') is-invalid @enderror" placeholder="Prénom de l'employé">
                            @error("newEmploye.prenom")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="">Sexe</label>
                            <select class="form-control @error('newEmploye.sexe') is-invalid @enderror" wire:model='newEmploye.sexe'>
                                <option value="">--------------</option>
                                <option value= "M">Homme</option>
                                <option value= "F">Femme</option>
                            </select>
                            @error("newEmploye.sexe")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                       <div class="form-group flex-grow-1">
                            <label>Adresse mail</label>
                            <input type="email" wire:model='newEmploye.email' class="form-control @error('newEmploye.email') is-invalid @enderror" placeholder="Enter email">
                            @error("newEmploye.email")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                       </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="">Situation Matrimoniale</label>
                            <select wire:model='newEmploye.situation_matrimoniale_id' class="form-control @error('newEmploye.situation_matrimoniale_id') is-invalid @enderror">
                                <option value="">--------------</option>
                                @foreach ($situationemployes as $item)
                                    <option value="{{$item->id}}">{{$item->libelle}}</option>
                                @endforeach
                            </select>
                            @error("newEmploye.situation_matrimoniale_id")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label for="">Nombre d'enfant</label>
                            <input type="number" wire:model='newEmploye.nombre_enfant' class="form-control @error('newEmploye.nombre_enfant') is-invalid @enderror">
                            @error("newEmploye.nombre_enfant")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2" wire:model='newEmploye.dateNaissance'>
                            <label>Date de naissance</label>
                            <input wire:model='newEmploye.dateNaissance' type="date" class="form-control @error('newEmploye.dateNaissance') is-invalid @enderror">
                            @error("newEmploye.dateNaissance")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Lieu de Naissance</label>
                            <input type="text" wire:model='newEmploye.lieu_naissance' class="form-control @error('newEmploye.lieu_naissance') is-invalid @enderror" placeholder="lieu de naissance de l'employé">
                            @error("newEmploye.lieu_naissance")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="">Type de pièce d'identité</label>
                            <select wire:model='newEmploye.piece_identite_id' class="form-control @error('newEmploye.piece_identite_id') is-invalid @enderror">
                                <option value="">--------------</option>
                                @foreach ($pieceIdentites as $item)
                                    <option value="{{$item->id}}">{{$item->libelle}}</option> 
                                @endforeach
                            </select>
                            @error("newEmploye.piece_identite_id")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Numero de Pièce d'identité</label>
                            <input type="text" class="form-control @error('newEmploye.numeroIdentite') is-invalid @enderror" wire:model='newEmploye.numeroIdentite' placeholder="Saisissez le numero de la pièce selectionné">
                            @error("newEmploye.numeroIdentite")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Commune</label>
                            <select class="form-control @error('newEmploye.commune_id') is-invalid @enderror" wire:model='newEmploye.commune_id'>
                                <option value="">--------------</option>
                                @foreach ($communeemployes as $item)
                                    <option value="{{$item->id}}">{{$item->libelle}}</option>
                                @endforeach
                            </select>
                            @error("newEmploye.commune_id")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label for="lastName">Quatier</label>
                            <input type="text" wire:model='newEmploye.quatier' class="form-control @error('newEmploye.quatier') is-invalid @enderror" placeholder="Quatier de l'employé">
                            @error("newEmploye.quatier")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="">Numero de téléphone </label>
                            <input wire:model='newEmploye.telephone1' type="text" class="form-control @error('newEmploye.telephone1') is-invalid @enderror" placeholder="Numero de télephone">
                            @error("newEmploye.telephone1")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label for="">Autre numero de télephone</label>
                            <input type="text" wire:model='newEmploye.telephone2' class="form-control @error('newEmploye.telephone2') is-invalid @enderror" placeholder="Autre numéro de téléphone">
                            @error("newEmploye.telephone2")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="">Fonction</label>
                            <select wire:model='newEmploye.fonction_id' class="form-control @error('newEmploye.fonction_id') is-invalid @enderror">
                                <option value="">--------------</option>
                                @foreach ($fonctions as $item)
                                    <option value="{{$item->id}}">{{$item->libelle}}</option>
                                @endforeach
                            </select>
                            @error("newEmploye.fonction_id")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">       
                            <label for="">Numero de permis de conduire</label>
                            <input type="text" wire:model='newEmploye.numeroPermis' class="form-control @error('newEmploye.numeroPermis') is-invalid @enderror" placeholder="Saisissez le numero de permis de conduire">
                            @error("newEmploye.numeroPermis")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label>Nom & prenom Personne à contacter</label>
                            <input type="text" wire:model='newEmploye.personContact' class="form-control @error('newEmploye.personContact') is-invalid @enderror">
                            @error("newEmploye.personContact")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Numero de personne à contacter</label>
                            <input type="text" wire:model='newEmploye.personContactNum' class="form-control @error('newEmploye.personContactNum') is-invalid @enderror">
                            @error("newEmploye.personContactNum")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="name">Numéro de CNPS</label>
                            <input type="text" wire:model='newEmploye.numeroCNPS' class="form-control" placeholder="Numero CNPS">
                            @error("newEmploye.numeroCNPS")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Numero de dossier</label>
                            <input type="number" wire:model='newEmploye.numeroDos' class="form-control" placeholder="Numero de dossier">
                            @error("newEmploye.numeroDos")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="name">Photo identité</label>
                            <input type="file" wire:model='addPhoto' class="form-control">

                            @error("addPhoto")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1" style="border: 1px solid #d0d1d3; border-radius: 20px; height: 200px; width:200px; overflow:hidden">
                            @if ($addPhoto)
                                <img src="{{ $addPhoto->temporaryUrl() }}" style="height:200px; width:200px;">
                            @endif
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="name">Photo CNI</label>
                            <input type="file" wire:model='addPhotoPiece' class="form-control">

                            @error("addPhotoPiece")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1" style="border: 1px solid #d0d1d3; border-radius: 20px; height: 200px; width:200px; overflow:hidden">
                            @if ($addPhotoPiece)
                                <img src="{{ $addPhotoPiece->temporaryUrl() }}" style="height:200px; width:200px;">
                            @endif
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="form-group flex-grow-1 mr-2">
                            <label for="name">Photo Acte de Naissance</label>
                            <input type="file" wire:model='addPhotoActe' class="form-control">

                            @error("addPhotoActe")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group flex-grow-1" style="border: 1px solid #d0d1d3; border-radius: 20px; height: 200px; width:200px; overflow:hidden">
                            @if ($addPhotoActe)
                                <img src="{{ $addPhotoActe->temporaryUrl() }}" style="height:200px; width:200px;">
                            @endif
                        </div>
                    </div>
                </div>
                
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Créer</button>
                    <button type="button" wire:click='goToListEmployee()' class="btn btn-danger">Retour à la liste des Employés</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            
        </div>
    </div>
</form>


