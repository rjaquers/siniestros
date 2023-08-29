<?php
include_once("c_connections/conec6.php");
include_once("c_connections/funciones.php");
 $perfil_autorizado = "2";
//// Si la pagina no es la correcta aquí lo va a lanzar a donde corresponda
 require_once('inc_session.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title><?php if (isset($_REQUEST['title'])) {
            echo $_REQUEST['title'];
        } ?></title>
    <?php include_once('inc_headers_meta.php'); ?>
    <!--    Js Jaque Funciones -->
    <script src="c_js/JaqueFunciones.js?q=<?php echo $tiempo; ?>&"></script>
</head>
<body>
<div class="page-wrapper">
    <div class="page-inner">
        <!-- BEGIN Left Aside -->
        <?php include_once("inc_sidebar.php"); ?>
        <!-- END Left Aside -->
        <div class="page-content-wrapper">
            <!-- BEGIN Page Header -->
            <?php include_once("inc_page_header.php"); ?>
            <!-- END Page Header -->

            <!-- BEGIN Page Content -->
            <!-- the #js-page-content id is needed for some plugins to initialize -->
            <main id="js-page-content" role="main" class="page-content">
                <ol class="breadcrumb page-breadcrumb ">
                    <li class="breadcrumb-item"><a href="home_admin.php">Inicio</a></li>
                    <li class="breadcrumb-item"><?php echo $_GET['seccion'] ?></li>
                    <li class="breadcrumb-item active"><?php echo  $_GET['titulo_pagina'] ; ?></li>

                    <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                </ol>
                <div class="subheader">
                    <h1 class="subheader-title">

                        <?php
                        switch ($_GET['seccion']) {
                            case "Panel de control":
                                echo " <i class='subheader-icon fa-solid   fa-home'></i>";
                                break;

                            case "Siniestros":
                                echo " <i class='subheader-icon fa-solid fa-car-burst '></i>";
                                break;

                            case "Administración":
                                echo " <i class='subheader-icon   fal fa-cogs'></i>";
                                break;
                        }
                        ?>




                        <span class='fw-300'><?php echo $_GET['titulo_pagina']; ?></span> <sup
                                class='badge badge-primary fw-500 d-none d-sm-none'>Secci&oacute;n</sup>
                        <small>
                            <?php echo htmlentities($_GET['desc_pagina'], ENT_NOQUOTES, "utf-8"); ?>
                        </small>
                    </h1>
                    <div class="subheader-block  ">
                        <?php echo $_SESSION['nombre_usuario']; ?> / <?php echo $_SESSION['nombre_perfil'] ?>
                    </div>
                </div>


                <!-- Inicio Posición del template-->
                <?php
                if (isset($_GET['template'])) {
                    include($_GET['template'].".php");
                } else {
                    include("t_home.php");
                }
                ?>
                <!-- Fin Posición del template-->
            </main>
            <!-- this overlay is activated only when mobile menu is triggered -->
            <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
            <!-- END Page Content -->

            <!-- BEGIN Page Footer -->
            <footer class="page-footer" role="contentinfo">
                <div class="d-flex align-items-center flex-1 text-muted">
                    <span class="hidden-md-down fw-700">2022 © Plataforma Web "Siniestros HyV" Creado por&nbsp;
                        <a href='https://www.gotbootstrap.com' class='text-primary fw-500' title='www.rkm.cl' target='_blank'>www.rkm.cl</a></span>
                </div>
                <div>
                    <ul class="list-table m-0 d-none d-sm-none">
                        <li>
                            <a href="http://www.rkm.cl" class="text-secondary fw-700 small  ">Acerca de Esta obra est&aacute; bajo una <a rel="license" class="small"   href="http://creativecommons.org/licenses/by/4.0/">Licencia Creative Commons Atribuci&oacute;n 4.0 Internacional</a>
                        </li>



                    </ul>
                </div>
            </footer>
            <!-- END Page Footer -->


        </div>
    </div>
</div>
<!-- END Page Wrapper -->
<!-- BEGIN Quick Menu -->
<!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
<nav class="shortcut-menu d-none d-sm-block">
    <input type="checkbox" class="menu-open" name="menu-open" id="menu_open"/>
    <label for="menu_open" class="menu-open-button ">
        <span class="app-shortcut-icon d-block"></span>
    </label>
    <a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Volver a la cima">
        <i class="fal fa-arrow-up"></i>
    </a>
    <a href="page_login_alt.html" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Salir">
        <i class="fal fa-sign-out"></i>
    </a>

    <a href="#" class="menu-item btn" data-action="app-print" data-toggle="tooltip" data-placement="left" title="Imprimir página">
        <i class="fal fa-print"></i>
    </a>
</nav>
<!-- END Quick Menu -->

<!-- BEGIN Page Settings -->

<!-- END Page Settings -->
<!-- base vendor bundle: -->


<script src="c_js/vendors.bundle.js"></script>
<script src="c_js/app.bundle.js"></script>
<script>
    $(document).ready(function () {
    });
</script>

<script src="c_js/datagrid/datatables/datatables.bundle.js"></script>
<script src="c_js/datagrid/datatables/datatables.export.js"></script>
<script>
    $(document).ready(function()
    {
        // initialize datatable
        $('#dt-basic-example').dataTable(
            {
                responsive: true,
                lengthChange: false,
                dom:

                    "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    // {
                    //     extend:    'colvis',
                    //     text:      'Column Visibility',
                    //     titleAttr: 'Col visibility',
                    //     className: 'mr-sm-3'
                    // },
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        titleAttr: 'Generate PDF',
                        className: 'btn-outline-danger btn-sm mr-1'
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        titleAttr: 'Generate Excel',
                        className: 'btn-outline-success btn-sm mr-1'
                    },
                    {
                        extend: 'csvHtml5',
                        text: 'CSV',
                        titleAttr: 'Generate CSV',
                        className: 'btn-outline-primary btn-sm mr-1'
                    },
                    // {
                    //     extend: 'copyHtml5',
                    //     text: 'Copy',
                    //     titleAttr: 'Copy to clipboard',
                    //     className: 'btn-outline-primary btn-sm mr-1'
                    // },
                    // {
                    //     extend: 'print',
                    //     text: 'Print',
                    //     titleAttr: 'Print Table',
                    //     className: 'btn-outline-primary btn-sm'
                    // }
                ]
            });
    });
</script>

</body>
</html>