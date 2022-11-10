<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route("home") }}" class="nav-link {{ setMenuClass('home', 'active') }}">
              <i class="nav-icon fas fa-home"></i>
              <p>Accueil</p>
            </a>
        </li>
        @can("manager")
        <li class="nav-item  ">
            <a href="#" class="nav-link">
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
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-swatchbook"></i>
                  <p>Locations</p>
                </a>
              </li>
            </ul>
        </li>
        
        <li class="nav-item {{ setMenuClass('manager.gestcomptes.', 'menu-open') }}">
            <a href="#" class="nav-link {{ setMenuClass('manager.gestcomptes.','active')}}">
              <i class=" nav-icon fas fa-user-shield"></i>
              <p>
                Gestion Comptes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route("manager.gestcomptes.users.index")}}" class="nav-link {{ setMenuActive("manager.gestcomptes.users.index") }}">
                  <i class=" nav-icon fas fa-users-cog"></i>
                  <p>Comptes</p>
                </a>
              </li>
            </ul>
          </li>
        </li>


        <li class="nav-item {{ setMenuClass('manager.gestsuccursales.','menu-open')}}">
            <a href="{{ route("manager.gestsuccursales.succursales") }}" class="nav-link {{ setMenuClass('manager.gestsuccursales.','active')}}">
            <i class="nav-icon fa-solid fa-building-user"></i>
              <p>
                Gestion Succursales
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route("manager.gestsuccursales.succursales")}}" class="nav-link {{ setMenuClass("manager.gestsuccursales.succursales","active") }}">
                  <i class="nav-icon fa-regular fa-building"></i>
                  <p>Succursales</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="{{ route("manager.gestsuccursales.departements")}}" class="nav-link {{ setMenuClass("manager.gestsuccursales.departements","active") }}">
                  <i class="nav-icon fa-solid fa-bars"></i>
                  <p>Départements</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="{{ route("manager.gestsuccursales.services")}}" class="nav-link {{ setMenuActive("manager.gestsuccursales.services") }}">
                  <i class="nav-icon fa-solid fa-bars"></i>
                  <p>Services</p>
                </a>
              </li> --}}
            </ul>
          </li>
        </li>
       
        @endcan 
               
        @can('assistant')
        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class=" nav-icon fas fa-user-shield"></i>
              <p>
                Gestion employes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a
                href=""
                class="nav-link"
                >
                  <i class=" nav-icon fas fa-users-cog"></i>
                  <p>Employés</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-fingerprint"></i>
                  <p>Black List</p>
                </a>
              </li>
            </ul>
          </li>
        </li>
        @endcan
    </ul>
</nav>