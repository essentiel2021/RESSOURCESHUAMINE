<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route("home") }}" class="nav-link {{ setMenuClass('home', 'active') }}">
              <i class="nav-icon fas fa-home"></i>
              <p>Accueil</p>
            </a>
        </li>
        @can("manager")
        <li class="nav-item {{ setMenuClass('manager.gestaffectations.', 'menu-open') }}">
            <a href="#" class="nav-link {{ setMenuClass('manager.gestaffectations.','active')}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tableau de bord
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>Vue globale</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route("manager.gestaffectations.historiques")}}" class="nav-link {{ setMenuActive("manager.gestaffectations.historiques")}}">
                  <i class="nav-icon fas fa-swatchbook"></i>
                  <p>Historique des affectations</p>
                </a>
              </li>
            </ul>
        </li>
        
        <li class="nav-item {{ setMenuClass('manager.gestcomptes.', 'menu-open') }}">
            <a href="#" class="nav-link {{ setMenuClass('manager.gestcomptes.','active')}}">
              {{-- <i class=" nav-icon fas fa-user-shield"></i> --}} <i class="nav-icon fa-solid fa-chalkboard"></i>
              <p>
                Gestion Comptes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route("manager.gestcomptes.users.index")}}" class="nav-link {{ setMenuActive("manager.gestcomptes.users.index") }}">
                  {{-- <i class=" nav-icon fas fa-users-cog"></i> --}} <i class="nav-icon fa-solid fa-chalkboard"></i>
                  <p>Comptes</p>
                </a>
              </li>
            </ul>
          </li>
        </li>
        @endcan 
               
        @can('assistant')
          <li class="nav-item {{ setMenuClass('assistant.gestsuccursales.','menu-open')}}">
            <a href="{{ route("assistant.gestsuccursales.succursales") }}" class="nav-link {{ setMenuClass('assistant.gestsuccursales.succursales','active')}}">
              <i class="nav-icon fa-solid fa-building-user"></i>
              <p>
                Gestion Succursales
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route("assistant.gestsuccursales.succursales")}}" class="nav-link {{ setMenuClass("assistant.gestsuccursales.succursales","active") }}">
                  <i class="nav-icon fa-regular fa-building"></i>
                  <p>Succursales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route("assistant.gestsuccursales.departements")}}" class="nav-link {{ setMenuClass("assistant.gestsuccursales.departements","active") }}">
                  <i class="nav-icon fa-solid fa-bars"></i>
                  <p>Départements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route("assistant.gestsuccursales.service")}}" class="nav-link {{ setMenuClass("assistant.gestsuccursales.service","active") }}">
                  <i class="nav-icon fa-solid fa-bars"></i>
                  <p>Services</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ setMenuClass('assistant.gestemployes.','menu-open')}}">
            <a href="#" class="nav-link {{ setMenuClass('assistant.gestemployes.','active')}}">
              {{-- <i class="nav-icon fa-solid fa-user"></i> --}} <i class="nav-icon fa-solid fa-users"></i>
              <p>
                Gestion Employes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route("assistant.gestemployes.employe.index")}}" class="nav-link {{ setMenuClass("assistant.gestemployes.employe.index","active") }}">
                  {{-- <i class="nav-icon fa-regular fa-building"></i> --}}<i class="fa-solid fa-users"></i>
                  <p>Employes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route("assistant.gestemployes.employe.black")}}" class="nav-link {{ setMenuClass("assistant.gestemployes.employe.black","active") }}">
                  {{-- <i class="nav-icon fa-solid fa-bars"></i> --}} <i class="fa-solid fa-user-xmark"></i>
                  <p>Black List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ setMenuClass('assistant.gestfonctions.','menu-open')}}">
            <a href="#" class="nav-link {{ setMenuClass('assistant.gestfonctions.','active')}}">
              <i class="nav-icon fa-solid fa-user-gear"></i>
              <p>
                Gestion Fonction
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route("assistant.gestfonctions.fonctions")}}" class="nav-link {{ setMenuClass("assistant.gestfonctions.fonctions","active") }}">
                <i class="nav-icon fa-solid fa-user-gear"></i>
                  <p>Fonctions</p>
                </a>
              </li>
            </ul>
          </li>
        @endcan
    </ul>
</nav>