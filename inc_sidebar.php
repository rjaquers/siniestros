<!-- BEGIN Left Aside -->
<aside class="page-sidebar">
    <div class="page-logo">
        <a href="<?php echo $_SESSION['home']; ?>" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
            <i class="fa-solid fa-car-on fa-2x"></i>
            <span class="page-logo-text mr-1">Foto Siniestos HyV</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>

        </a>
    </div>
    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
         

        <ul id="js-nav-menu" class="nav-menu">
            <li>
                <a href="index.php" title="Panel de control"  >
                    <i class="fa-solid fa-home text-secondary"></i> <span class="nav-link-text" >
                        Inicio </span>
                </a>
            </li>



            <li>
                <a href="#" title="Application Intel" data-filter-tags="application intel">
                    <i class="fa fa-car"></i>
                    <span class="nav-link-text" data-i18n="nav.application_intel">  Siniestros</span>
                </a>
                <ul>
                    <li>
                        <a href="<?php echo $_SESSION['home']; ?>?template=t_siniestro_crear&accion=crear&titulo_pagina=Siniestro%3ECrear&seccion=Siniestros&desc_pagina=Sistema%20de%20registro%20de%20nuevos%20Siniestros%20por%20patente" title="Nuevo siniestro" data-filter-tags="Aplicación informe de siniestros">

                            <i class="fa  fa-plus-circle text-secondary small"></i>

                            <span class="nav-link-text" >  Nuevo&nbsp;   </span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo $_SESSION['home']; ?>?template=t_siniestros_listar&accion=Listar&titulo_pagina=Administración>Estado&seccion=Administraci&oacute;n&desc_pagina= Panel de Estados" title="Estados" data-filter-tags="application intel analytics dashboard">
                            <i class="fa fa-list  text-secondary small"></i>

                            <span class="nav-link-text" >  Listar  </span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo $_SESSION['home']; ?>?template=t_patente_crear&accion=Listar&titulo_pagina=Patentes>Registrar fotos&seccion=Siniestros&desc_pagina=Registrar Fotos de siniestros, ordenados por patente y registro" title="Registrar Fotos Siniestros"     >
                            <i class="fa-solid fa-camera-alt text-secondary"></i>
                            <span class="nav-link-text"  > Fotos </span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $_SESSION['home']; ?>?template=t_patentes_listar&accion=Listar&titulo_pagina=Patentes>Listar&seccion=Siniestros&desc_pagina=Listado de siniestros, ordenados por patente y registro" title="Listado de siniestros"    >
                            <i class="fa-solid fa-car-burst text-secondary"></i> <span class="nav-link-text"  >
                        Patentes </span>
                        </a>
                    </li>
                </ul>
            </li>


            <?php if($_SESSION['id_perfil'] == 1) { ?>
                <hr>
            <li>
                <a href="#" title="Application Intel" data-filter-tags="application intel">
                    <i class="fal fa-cogs text-secondary"></i>
                    <span class="nav-link-text" data-i18n="nav.application_intel">
                        Administraci&oacute;n</span>
                </a>
                <ul>
                    <li>
                        <a href="<?php echo $_SESSION['home']; ?>?template=t_usuarios_listar&accion=Listar&titulo_pagina=Administración>Usuarios&seccion=Administraci&oacute;n&desc_pagina=Panel de usuarios" title="Usuario" data-filter-tags="Aplicación informe de siniestros">
                            <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">
                                  Usuarios &nbsp; <i class="fa fa-solid fa-user text-secondary small"></i></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $_SESSION['home']; ?>?template=t_estado_listar&accion=Listar&titulo_pagina=Administración>Estado&seccion=Administraci&oacute;n&desc_pagina= Panel de Estados" title="Estados" data-filter-tags="application intel analytics dashboard">
                            <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">
                                Estados&nbsp;
                                <i class="fa-solid fa-arrows-to-eye  text-secondary small"></i>
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php } ?>




        </ul>
        <div class="filter-message js-filter-message bg-success-600"></div>
    </nav>
    <!-- END PRIMARY NAVIGATION -->
    <!-- NAV FOOTER -->
    <div class="nav-footer shadow-top">
        <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify" class="hidden-md-down">
            <i class="ni ni-chevron-right"></i>
            <i class="ni ni-chevron-right"></i>
        </a>
        <ul class="list-table m-auto nav-footer-buttons">

            <li>
                <a href="https://api.whatsapp.com/send?phone=56961405440&text=Hola,%20Necesito%20soporte%20Sistema%20Foto%20Siniestros%20HyV" data-toggle="tooltip" data-placement="top" title="Solicitar soporte por Chat" target="_blank">
                    <i class="fal fa-comments"></i>
                </a>
            </li>
            <li>
                <a href="http://www.hyv.cl" data-toggle="tooltip" data-placement="top" title="Sitio Web Empresa" target="_blank">
                    <i class="fa-solid fa-link"></i>
                </a>
            </li>
            <li>
                <a href="tel:+56961405440" data-toggle="tooltip" data-placement="top" title="Llamar a Soporte" target="_blank">
                    <i class="fal fa-phone"></i>
                </a>
            </li>
        </ul>
    </div> <!-- END NAV FOOTER -->
</aside>
<!-- END Left Aside -->