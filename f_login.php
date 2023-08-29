<?php   $tiempo = date("Y-m-d H:i:s");
if (isset($_COOKIE['contador'])) {
    // Caduca en un año
    setcookie('contador', $_COOKIE['contador'] + 1, time() + 365 * 24 * 60 * 60);
    $mensaje = 'Número inicio de sesión: '.$_COOKIE['contador'];
} else {
    // Caduca en un año
    setcookie('contador', 1, time() + 365 * 24 * 60 * 60);
    $mensaje = 'Ultima vez que estuvo aquí fue el: ' .  $tiempo;
}

?>
<!DOCTYPE html>
<!-- 
Template Name:  Siniestros HyV Responsive WebApp - Template build with Twitter Bootstrap 4
Version: 4.0.2
Author: Sunnyat Ahmmed
Website: http://gootbootstrap.com
Purchase: https://wrapbootstrap.com/theme/Siniestros HyV-responsive-webapp-WB0573SK0
License: You must have a valid license purchased only from wrapbootstrap.com (link above) in order to legally use this theme for your project.
-->
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>
           Siniestros HyV.cl
        </title>
        <?php include("inc_headers_meta.php"); ?>

    </head>
    <body>
        <div class="page-wrapper">
            <div class="page-inner bg-brand-gradient">
                <div class="page-content-wrapper bg-transparent m-0">
                    <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                        <div class="d-flex align-items-center container p-0">
                            <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9">
                                <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                                    <img src="img/logo.png" alt="WebApp Foto Siniestros" aria-roledescription="logo">
                                    <span class="page-logo-text mr-1">Siniestros App</span>
                                </a>
                            </div>
                            <a href="f_registro.php" class="btn-link text-white ml-auto">
                               Solicitar Soporte
                            </a>
                        </div>
                    </div>
                    <div class="flex-1" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                        <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                            <div class="row">
                                <div class="col col-md-6 col-lg-7 hidden-sm-down">
                                    <h2 class="fs-xxl fw-500 mt-4 text-white">
                                       Sistema de registro de fotos de siniestros.
                                        <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60">
                                           Sistema en plataforma Web desarrollado para la empresa Automotora HyV.
                                        </small>
                                    </h2>

                                 <?php if(isset($_GET['error'])) { ?>
                                  <div class="alert alert-danger alert-dismissible fade show">
                                                                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                                          <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                                                                      </button>
                                                                                      <div class="d-flex align-items-center">
                                                                                          <div class="alert-icon width-8">
                                                                                              <span class="icon-stack icon-stack-xl">
                                                                                                  <i class="base-2 icon-stack-3x color-danger-400"></i>
                                                                                                  <i class="base-10 text-white icon-stack-1x"></i>
                                                                                                  <i class="ni md-profile color-danger-800 icon-stack-2x"></i>
                                                                                              </span>
                                                                                          </div>
                                                                                          <div class="flex-1 pl-1">
                                                                                              <span class="h2">
                                                                                                 Error en los datos ingresados, intente nuevamente
                                                                                              </span>
                                                                                              <br>
                                                                                  Tipo de error: <?php echo $_GET['error']; ?>
                                                                                           </div>
                                                                                      </div>
                                                                                  </div>
                                  <?php }  ?>


                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto">
                                    <h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">
                                        Sistema Seguro
                                    </h1>
                                    <div class="card p-4 rounded-plus bg-faded">



                                        <form id="js-login" novalidate="" action="query/q_login.php" enctype="multipart/form-data" method="post">
                                            <div class="form-group">
                                                <label class="form-label" for="username">Usuario:</label>
                                                <input type="email" name="usuario" id="usuario" class="form-control form-control-lg" placeholder="su correo" value="" required>
                                                <div class="invalid-feedback">Error, debe registrar el correo.</div>
                                                <div class="help-block">Su usuario</div>

                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="password">Clave:</label>
                                                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="password" value="" required>
                                                <div class="invalid-feedback">Error, debe registrar su clave</div>
                                                <div class="help-block">Su clave</div>
                                            </div>

                                            <div class="form-group text-left">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="botonVer" name="botonVer" value="1"  onclick="fnjava_verClave('password','botonVer')">
                                                    <label  > Mostrar clave</label>


                                                    <a href="f_recuperar_clave.php" class="fa-pull-right"><label> Recuperar clave</label></a>
                                                </div>
                                            </div>



                                            <div class="row no-gutters">

                                                <div class="col-lg-6 pl-lg-1 my-2">
                                                    <button id="js-login-btn" type="submit" class="btn btn-danger btn-block btn-lg">Registrarse</button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id_formulario" value="100">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                               2022© Sistema de Sinistros H y V&nbsp; /  <?php echo $mensaje; ?>
                                <br><a href='https://www.gotbootstrap.com' class='text-white opacity-40 fw-500' title='gotbootstrap.com' target='_blank'>Desarrollado por www.rkm.cl</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- base vendor bundle: 
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
        <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
        <script>
            $("#js-login-btn").click(function(event)
            {

                // Fetch form to apply custom Bootstrap validation
                var form = $("#js-login")

                if (form[0].checkValidity() === false)
                {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.addClass('was-validated');
                // Perform ajax submit here...
            });




        </script>
    <style>
        .float{
            position:fixed;
            width:60px;
            height:60px;
            bottom:40px;
            right:40px;
            background-color:#25d366;
            color:#FFF;
            border-radius:50px;
            text-align:center;
            font-size:30px;
            box-shadow: 2px 2px 3px #999;
            z-index:100;
        }
        .float:hover {
            text-decoration: none;
            color: #25d366;
            background-color:#fff;
        }

        .my-float{
            margin-top:16px;
        }
    </style>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <a href="https://api.whatsapp.com/send?phone=56961405440&text=Quisiera%20soporte%20por%20favor,%20en%20el%20sistema%20de%20siniestos%20de%20HyV" class="float" target="_blank">
            <i class="fa fa-whatsapp my-float"></i>
        </a>




    </body>
</html>
