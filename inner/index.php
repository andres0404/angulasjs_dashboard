<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.

-->
<html ng-app="facturacionApp" ng-controller="mainCtrl" >
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema de {{ config.aplicativo }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="dist/css/skins/skin-green.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Estilos Personalizados -->
    <link rel="stylesheet" href="dist/css/animate.css">

    

    <!-- Importaciones de angular -->
    <script src="../node_modules/angular/angular.min.js"></script>
    <script src="../node_modules/angular-route/angular-route.min.js"></script>
    <script src="../bower_components/angular-auto-validate/dist/jcs-auto-validate.min.js"></script>


    <!-- Controladores -->
    <script src="src/config.js"></script>
    <script src="src/app.js"></script>
    <script src="src/service_info.js"></script>
    <script src="src/service_mensajes.js"></script>
    <script src="src/service_notificaciones.js"></script>
    <script src="src/service_clientes.js"></script>
    <script src="src/service_paises.js"></script>
    <script src="src/service_factura.js"></script>
    <script src="src/p.js"></script>
    <script src="src/clientesCtrl.js"></script>
    <script src="src/facturaCtrl.js"></script>
    <script src="src/routes.js"></script>
   

    <!-- servicios -->
    <!-- <script src="angular/servicios/configuracion_service.js"></script>
    <script src="angular/servicios/mensajes_service.js"></script>
    <script src="angular/servicios/notificaciones_service.js"></script>
    <script src="angular/servicios/clientes_service.js"></script> -->

  </head>
 


  <body class="hold-transition skin-green sidebar-mini" >
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->  
          <span class="logo-mini"><b>{{ config.iniciales[0] }}</b>{{ config.iniciales | quitarletra }}</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b> {{ config.aplicativo }} </b>{{ config.iniciales }}</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- Messages: style can be found in dropdown.less-->
              <li class="dropdown messages-menu" ng-include="'template/mensajes.html'">
              </li>
              <!-- /.messages-menu -->

              <!-- Notifications Menu  -->
              <li class="dropdown notifications-menu" ng-include="'template/notificaciones.html'">
              </li>

              <!-- User Account Menu -->
              <li class="dropdown user user-menu" ng-include="'template/usuario.html'" >
              </li>

            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar" ng-include="'template/menu.html'" >
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

          <h1>
            {{ titulo }}
            <small>{{ subtitulo }}</small>
          </h1>

        </section>

        <!-- Main content -->
        <section class="content">
          <div ng-view></div>
        contenido
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          {{ config.version }}
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{ config.anio }} 
         {{config.empresa}}.
        </strong> Derechos reservados.
      </footer>

    
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <!-- <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script> -->
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>
