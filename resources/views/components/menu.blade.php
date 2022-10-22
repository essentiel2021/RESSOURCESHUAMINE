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
        
        <li class="nav-item {{ setMenuClass('manager.','menu-open')}}">
            <a href="#" class="nav-link {{ setMenuClass('manager.','active')}}">
              <i class=" nav-icon fas fa-user-shield"></i>
              <p>
                Gestion Comptes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route("manager.users.index") }}" class="nav-link {{ setMenuActive("manager.users.index") }}">
                  <i class=" nav-icon fas fa-users-cog"></i>
                  <p>Utilisateurs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-fingerprint"></i>
                  <p>Roles et permissions</p>
                </a>
              </li>
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
                  <p>Utilisateurs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-fingerprint"></i>
                  <p>Roles et permissions</p>
                </a>
              </li>
            </ul>
          </li>
        </li>
        @endcan
    </ul>
</nav>