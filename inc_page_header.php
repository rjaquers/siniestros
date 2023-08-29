<!-- BEGIN Page Header -->
<header class="page-header" role="banner">
    <!-- we need this logo when user switches to nav-function-top -->
    <div class="page-logo">
        <a href="<?php echo $_SESSION['home']; ?>" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
            <i class="fa-solid fa-car-on fa-2x"></i>
            <span class="page-logo-text mr-1">Siniestros HyV</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- DOC: nav menu layout change shortcut -->
    <div class="hidden-md-down dropdown-icon-menu position-relative">
        <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Esconder menú">
            <i class="ni ni-menu"></i>
        </a>
        <ul>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minimizar menú">
                    <i class="ni ni-minify-nav"></i>
                </a>
            </li>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Bloquear navegación">
                    <i class="ni ni-lock-nav"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- DOC: mobile button appears during mobile width -->
    <div class="hidden-lg-up">
        <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
            <i class="ni ni-menu"></i>
        </a>
    </div>
    <div class="search">
         <figure><i class="fa-solid fa-car-on fa-3x img img-fluid"></i> </figure>
    </div>

    <div class="search">
        <form class="app-forms hidden-xs-down" role="search" action="<?php echo $_SESSION['home']; ?>" method="get">
            <div class="row">
                <input type="text" name="patente"  id="search-field" placeholder="B&uacute;squeda por patente" class="form-control bg-warning" tabindex="1">
                <input type="submit" value="buscar">
            </div>


            <a href="#" onclick="return false;" class="btn-danger btn-search-close js-waves-off d-none" data-action="toggle" data-class="mobile-search-on">
                <i class="fal fa-times"></i>
            </a>

            <input type="hidden" name="accion" value="buscar">
            <input type="hidden" name="template" value="t_patentes_buscar">
            <input type="hidden" name="titulo_pagina" value="Patentes">
            <input type="hidden" name="seccion" value="Administracion">
            <input type="hidden" name="desc_pagina" value="Buscar siniestros de la patente">
        </form>
    </div>
    <div class="ml-auto d-flex">
        <!-- activate app search icon (mobile) -->
        <div class="hidden-sm-up">
            <a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on" data-focus="search-field" title="Search">
                <i class="fal fa-search"></i>
            </a>
        </div>





        <!-- app user menu -->
        <div>
            <a href="exit.php"   title="Salir" class="header-icon d-flex align-items-center justify-content-center ml-2">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">Salir</span>

            </a>

        </div>
    </div>
</header>
<!-- END Page Header -->