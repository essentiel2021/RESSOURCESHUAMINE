
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GESTION RESSOURCES HUMAINES</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

   <link rel="stylesheet" href="{{mix("css/app.css")}}" />
    @livewireStyles
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <x-topnav/>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
   <a href="index3.html" class="brand-link">
      <span class="brand-text font-weight-bold" style="font-size: 1.3em;"><b>GESTIONRH</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('images/user1-128x128.jpg')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ userFullName() }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <x-menu/>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
         @yield("contenu") 
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- Control Sidebar -->
  <x-sidebar/>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <x-footer/>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

    <script src="{{ mix('js/app.js') }}"></script>
    @livewireScripts
</body>
</html>


