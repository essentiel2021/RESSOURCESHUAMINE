<div class="row p-4 pt-5">
  <div class="col-md-6">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i>Formulaire d'édition de compte</h3>
      </div>
      <form role="form" wire:submit.prevent="updateUser()">
        <div class="card-body">
          <div class="d-flex">
            <div class="form-group flex-grow-1 mr-2">
              <label for="name">Nom</label>
              <input type="text" class="form-control @error('editUser.name') is-invalid @enderror" wire:model="editUser.name" id="name"  placeholder="Entrez votre nom">
                @error("editUser.name")
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group flex-grow-1">
              <label for="lastName">Prénom</label>
              <input type="text" class="form-control @error('editUser.lastName') is-invalid @enderror" wire:model='editUser.lastName' id="lastName" placeholder="Entrez votre nom">
              @error("editUser.lastName")
                  <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
          </div>
          <div class="form-group">
            <label for="">Sexe</label>
            <select class="form-control @error('editUser.sexe') is-invalid @enderror" wire:model="editUser.sexe">
              <option value="">--------------</option>
              <option value="M">Homme</option>
              <option value="F">Femme</option>
            </select>
            @error("editUser.sexe")
              <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control @error('editUser.email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter email" wire:model="editUser.email">
            @error("editUser.email")
                <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Modifier</button>
          <button type="button" wire:click='goToListUser()' class="btn btn-danger">Retour à la liste des comptes </button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-key fa-2x"></i> Réinitialisation de mot de passe</h3>
          </div>
          <div class="card-body">
            <ul>
              <li>
                <a href="#" class="btn btn-link" wire:click.prevent="confirmPwdReset()">Réinitialiser le mot de passe</a>
                <span>(par défaut: "Password@9419") </span>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-12 mt-4">
        <div class="card card-primary">
          <div class="card-header d-flex align-items-center">
            <h3 class="card-title flex-grow-1"> <i class="fas fa-fingerprint fa-2x"></i> Rôles & Permissions</h3>
            <button class="btn bg-gradient-success" wire:click="updateRoleAndPermissions"><i class="fas fa-check"></i>Appliquer les modifications</button>
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
              {{-- @json($rolePermissions["roles"]) --}}
            </div>
          </div>
          <div class="p-3">
            <table>
              <table class="table table-bordered">
                <thead>
                  <th>Permissions</th>
                  <th></th>
                </thead>
                <tbody>
                  @foreach($rolePermissions["permissions"] as $permission)
                    <tr>
                      <td>{{$permission["permission_libelle"]}}</td>
                      <td>
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                          <input type="checkbox" class="custom-control-input" wire:model.lazy="rolePermissions.permissions.{{$loop->index}}.active" id="customSwitchPermission{{$permission["permission_id"]}}" @if($permission["active"])checked @endif>
                          <label class="custom-control-label" for="customSwitchPermission{{$permission["permission_id"]}}">{{ $permission["active"] ? "Activé" : "Désactivé" }}</label>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                  {{-- @json($rolePermissions["permissions"]) --}}
                </tbody>
                <tfoot>
                  hello
                </tfoot>
              </table>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
