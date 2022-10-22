
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="card bg-dark">
      <div class="card-body bg-dark box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle"src="{{ asset('images/user.png') }}"alt="User profile picture">
        </div>

        <h3 class="profile-username text-center ellipsis">{{  userFullName() }}</h3>

        <p class="text-muted text-center">{{ getRolesName() }}</p>

        <ul class="list-group bg-dark mb-3">
          <li class="list-group-item">
            <a href="#" class="d-flex align-items-center"><i class="fa fa-lock pr-2"></i><b>Mot de passe</b></a>
          </li>
          <li class="list-group-item">
            <a  href="#" class="d-flex align-items-center"><i class="fa fa-user pr-2"></i><b>Mon profile</b></a>
          </li>
        </ul>
        <a href="{{ route('login') }}" class="btn btn-primary btn-block"><b>Déconnexion</b></a>
      </div>
    </div>
  </aside>
  