<div class="row p-4 pt-5">
             <!-- general form elements -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><i class="fas fa-user-plus fa-2x"></i>Formulaire de création de compte</h3>
    </div>
    <form role="form" wire:submit.prevent="addUser()">
      <div class="card-body">
        <div class="d-flex">
          <div class="form-group flex-grow-1 mr-2">
            <label for="name">Nom</label>
            <input type="text" class="form-control @error('newUser.name') is-invalid @enderror" wire:model="newUser.name" id="name"  placeholder="Entrez votre nom">
              @error("newUser.name")
                <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
          <div class="form-group flex-grow-1">
            <label for="lastName">Prénom</label>
            <input type="text" class="form-control @error('newUser.lastName') is-invalid @enderror" wire:model='newUser.lastName' id="lastName" placeholder="Entrez votre nom">
             @error("newUser.lastName")
                <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
        </div>
        <div class="form-group">
          <label for="">Sexe</label>
          <select class="form-control @error('newUser.sexe') is-invalid @enderror" wire:model="newUser.sexe">
            <option value="">--------------</option>
            <option value="M">Homme</option>
            <option value="F">Femme</option>
          </select>
          @error("newUser.sexe")
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input type="email" class="form-control @error('newUser.email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Enter email" wire:model="newUser.email">
           @error("newUser.email")
              <span class="text-danger">{{ $message }}</span>
           @enderror
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Mot de passe</label>
          <input type="password" class="form-control" id="exampleInputPassword1" disabled placeholder="Entrez le Mot de passe">
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Créer</button>
        <button type="button" wire:click='goToListUser()' class="btn btn-danger">Retour à la liste des comptes </button>
      </div>
    </form>
  </div>
</div>