<body class="skin-blue sidebar-mini ">

  <div id="loader-wrapper">
    <div id="loader"></div>

    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>

  </div>

  <link rel="stylesheet" href="resources/css/style3.css">
  <link rel="stylesheet" href="resources/css/jquery.menu.min.css">

  <script src="resources/js/jquery.menu.min.js"></script>
  <style type="text/css">
    .nav-container {
      min-height: 80px;
      z-index: 1000;
    }

    .container {
      max-width: 100%;
      background-color: #F8F9FA;
      z-index: 1000;
    }
  </style>
  <div class="overlay"></div>

  <div class="nav-container">
    <nav id="menu" class="navbar navbar-expand-lg fixed-top shadow navbar-light" style="background-color: #034EA2;">

      <div class="col-sm-2">
        <button class="btn btn-light" type="button" id="sidebarCollapse"><i class="fas fa-bars fa-lg"></i> MENU</button>
      </div>
      <div class="col-sm-8" style="width: 100%">

      </div>
      <div class="col-sm-2">
      </div>


    </nav>
  </div>

  <nav id="sidebar">
    <div class="sidebar-header text-center">
      <h4>Menu</h4>
    </div>
    <ul class="list-unstyled components">
      <span class="text-center">
        <h4>Men&uacute;</h4>
      </span>

      <!-- <li>
        <a href="#menu_0" data-toggle="collapse" id="config_parametros" aria-expanded="false"><span>Entrada</span></a>
      </li> -->
      <li>
        <a href="#" id="usuario_menu"><span>Usuario</span></a>
      </li>

      <!-- <li>
        <a href="#menu_2" data-toggle="collapse" aria-expanded="false"><span>Notas Log&iacute;stica</span></a>
        <ul class="collapse list-unstyled" id="menu_2">
          <li><a href="#" id="notas_logistica_menu"><i class="fas fa-cart-arrow-down"></i> Migraci&oacute;n notas log&iacute;stica</a></li>
          <li><a href="#" id="notas_cartera_logistica_menu"><i class="fas fa-cogs"></i> Configuraci&oacute;n notas log&iacute;stica</a></li>
        </ul>
      </li>

      <li>
        <a href="#menu_3" data-toggle="collapse" aria-expanded="false"><span>Notas Contabilidad</span></a>
        <ul class="collapse list-unstyled" id="menu_3">
          <li><a href="#" id="notas_contabilidad_menu"><i class="fas fa-cart-arrow-down"></i> Migraci&oacute;n notas contabilidad</a></li>
          <li><a href="#" id="notas_contabilidad_config_menu"><i class="fas fa-cogs"></i> Configuraci&oacute;n notas contabilidad</a></li>
        </ul>
      </li>
      <li>
        <a href="#menu_4" data-toggle="collapse" aria-expanded="false"><span>Notas Devolucion de IBG</span></a>
        <ul class="collapse list-unstyled" id="menu_4">
          <li><a href="#" id="notas_contabilidad_promodctos"><i class="fas fa-cart-arrow-down"></i> Migraci&oacute;n notas devoluci&oacute;n</a></li>
          <li><a href="#" id="notas_devolucion_config_menu"><i class="fas fa-cogs"></i> Configuraci&oacute;n notas devoluci&oacute;n</a></li>
        </ul>
      </li>

      <li>
        <a href="#menu_5" data-toggle="collapse" aria-expanded="false"><span>Notas Devolucion Global</span></a>
        <ul class="collapse list-unstyled" id="menu_5">
          <li><a href="#" id="notas_cartera_devo_global"><i class="fas fa-cart-arrow-down"></i> Migraci&oacute;n notas Global</a></li>
          <li><a href="#" id="notas_devolucion_global_config_menu"><i class="fas fa-cogs"></i> Configuraci&oacute;n notas devoluci&oacute;n</a></li>
        </ul>
      </li>

      <li>
        <a href="#menu_6" data-toggle="collapse" aria-expanded="false"><span>Notas Devolucion de PromoDescuento</span></a>
        <ul class="collapse list-unstyled" id="menu_6">
          <li><a href="#" id="notas_cartera_devo_promodesc"><i class="fas fa-cart-arrow-down"></i> Migraci&oacute;n notas PromoDescuento</a></li>
          <li><a href="#" id="notas_devolucion_promodesc_config_menu"><i class="fas fa-cogs"></i> Configuraci&oacute;n notas devoluci&oacute;n</a></li>
        </ul>
      </li> -->


      <!-- <li><a href="#"> Salir</a></li> -->
    </ul>
  </nav>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#sidebar").mCustomScrollbar("scrollTo", "bottom", {
        scrollInertia: 3000,
      });

      $('#dismiss, .overlay').on('click', function() {
        $('#sidebar').removeClass('active');
        $('.overlay').removeClass('active');
      });

      $('#sidebarCollapse').on('click', function() {
        $('#sidebar').addClass('active');
        $('.overlay').addClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
      });
    });
  </script>