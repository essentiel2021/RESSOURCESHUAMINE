
<form role="form" wire:submit.prevent="">
</form>

<div class="row p-4 pt-5">
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Different Height</h3>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <div class="form-group flex-grow-1 mr-2">
                        <label for="name">Numéro de CNPS</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Numero CNPS">
                    </div>
                    <div class="form-group flex-grow-1">
                        <label for="lastName">Numero de dossier</label>
                        <input type="number" class="form-control" id="lastName" placeholder="Numero de dossier">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="">Photo</label>
                    <input type="file" class="form-control" id="lastName" placeholder="">
                </div>
                <div class="form-group flex-grow-1">
                    <label for="">Photo pièce d'indentité</label>
                    <input type="file" class="form-control" id="lastName" placeholder="">
                </div>
                <div class="form-group flex-grow-1">
                    <label for="">Photo pièce extrait de naissance</label>
                    <input type="file" class="form-control" id="lastName" placeholder="">
                </div>
            </div> 
            <!-- /.card-body -->
        </div>
    </div>
    <div class="col-md-6" style="border: 1px solid #d0d1d3; border-radius: 20px; height: 200px; width:200px; overflow:hidden;">
    </div>    
</div>

 <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Different Height</h3>
            </div>
            <div class="card-body">
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
                        @error("newEmploye.quatier ")
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex">
                    <div class="form-group flex-grow-1 mr-2">
                        <label for="">Numero de téléphone </label>
                        <input wire:model='newEmploye' type="text" class="form-control @error('newEmploye.telephone1') is-invalid @enderror"placeholder="Numero de télephone">
                    </div>
                    <div class="form-group flex-grow-1">
                        <label for="">Autre numero de télephone</label>
                        <input type="text" wire:model='' class="form-control @error('newEmploye.telephone1') is-invalid @enderror" placeholder="Autre numéro de téléphone">
                    </div>
                </div>
                <div class="d-flex">
                    <div class="form-group flex-grow-1 mr-2">
                        <label for="">Adresse mail</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group flex-grow-1">
                        <label for="exampleInputEmail1">Numero de permis de conduire</label>
                        <input type="text" class="form-control" id="" placeholder="Saisissez le numero de permis de conduire">
                    </div>
                </div>
                <div class="d-flex">
                    <div class="form-group flex-grow-1 mr-2">
                        <label for="datetimepicker">Nom & prenom Personne à contacter</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group flex-grow-1">
                        <label for="exampleInputEmail1">Numero de personne à contacter</label>
                        <input type="text" class="form-control" id="exampleInputEmail1">
                    </div>
                </div>
            </div> 
            <!-- /.card-body -->
        </div>
    </div>


    @if ($photo)
        <img src="{{ $photo->temporaryUrl() }}">
    @endif