
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
//$validateAttribute['editEmploye']["blackList"] = $this->editEmploye["blackList"];



<div class="d-flex">
                        <label class="">BlackList</label>
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success form-group flex-grow-1">
                            <input wire:model='editEmploye.blackList' @if($editEmploye["blackList"])checked @endif type="checkbox" class="custom-control-input" id="customSwitch{{ $editEmploye["id"]}}">
                            <label class="custom-control-label" for="customSwitch{{ $editEmploye["id"]}}">{{ $editEmploye["blackList"] == 0 ? "Activé" : "Désactivé" }}</label>
                        </div>
                        <div class="form-group flex-grow-1">
                            <label>Numero de dossier</label>
                            <input type="number" wire:model='editEmploye.numeroDos' class="form-control" placeholder="Numero de dossier">
                            @error("editEmploye.numeroDos")
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>









<div class="card card-primary">
    <div class="card-header d-flex align-items-center">
        <h3 class="card-title flex-grow-1"> <i class="fas fa-fingerprint fa-2x"></i> Rôles & Permissions</h3>
        <button class="btn bg-gradient-success"><i class="fas fa-check"></i>Appliquer les modifications</button>
    </div>
    <div class="card-body">
        <div id="accordion">
            @foreach($rolePermissions["roles"] as $role)
                <div class="card">
                  <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title flex-grow-1">
                      <a  data-parent="#accordion" href="#"  aria-expanded="true">{{$role["role_libelle"]}}</a>
                    </h4>
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input type="checkbox" class="custom-control-input" wire:model.lazy="rolePermissions.roles.{{$loop->index}}.active" id="customSwitch{{$role["role_id"]}}" @if($role["active"])checked @endif>
                      <label class="custom-control-label" for="customSwitch{{$role["role_id"]}}">{{ $role["active"] ? "Activé" : "Désactivé" }}</label>
                    </div>
                  </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


<a href="{{route("manager.gestsuccursales.departements.service",['id'=>$departement->id])}}" title= "Ajout services" class="btn btn-link"> <i class="fa-sharp fa-solid fa-money-check"></i> </a>


<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Quick Example</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form>
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
          <label for="exampleInputFile">File input</label>
          <div class="input-group">
            <div class="input-group-append">
              <span class="input-group-text">Upload</span>
            </div>
          </div>
        </div>
        <div class="form-check">
          <input type="checkbox" class="form-check-input" id="exampleCheck1">
          <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
</div>