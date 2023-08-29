<?php
include_once("c_connections/conec6.php");
include_once("c_connections/funciones.php");
if (isset($_GET['id_siniestro'])) {
    $id_siniestro = trim(filter_input(INPUT_GET, 'id_siniestro', FILTER_SANITIZE_NUMBER_INT));
    $nro_siniestro = trim(filter_input(INPUT_GET, 'nro_siniestro', FILTER_SANITIZE_STRING));
    $patente = trim(filter_input(INPUT_GET, 'patente', FILTER_SANITIZE_STRING));
    $q_hist_siniestro = sprintf( "SELECT `id_estado_siniestro`, `id_siniestro`, `id_estado`, `id_usuario`, `fecha_registro`, `fecha_actualizacion` 
                                        FROM `tbl_estados_historial` WHERE `id_siniestro` = %d ",
                            $id_siniestro  );
    $re_hist_siniestro = mysqli_query($conec6, $q_hist_siniestro) or die(mysqli_error($conec6)." - Error 43 $q_hist_siniestro");
    $row_hist_siniestro = mysqli_fetch_assoc($re_hist_siniestro);
    $totalRows_hist_siniestro = mysqli_num_rows($re_hist_siniestro);


}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Ver fotos Siniestros</title>
    <?php include_once('inc_headers_meta.php'); ?>
    <!--    Js Jaque Funciones -->
    <script src="c_js/JaqueFunciones.js?q=<?php echo $tiempo; ?>&"></script>
</head>

<body>
<div class="container">
    <header>
        <div class="col-xl-12">
            <img class="d-block mx-auto mb-4 img-thumbnail" src="img/logohyv.png" alt="Hyv" style="max-width: 100px">
        </div>
    </header>
    <main>
        <section>
            <div class="px-4 py-5 my-5 text-center">
                <h1 class="display-5 fw-bold">Patente :</strong> <?php echo strtoupper($patente); ?></h1>
                <div class="col-lg-6 mx-auto">
                    <p class="lead mb-4">Listado de Siniestros y fotos del vehículo registrado.</p>

                </div>
            </div>
        </section>
        <div class="b-example-divider mb-0"></div>
        <section>
            <div class="px-4 py-5 my-5 text-center">
                <div class="panel-content">
                    <div class="row">
                        <?php if ($totalRows_hist_siniestro > 0) { ?>
                            <table class="table table-bordered table-hover  w-100 dataTable dtr-inline" role="grid" aria-describedby="dt-basic-example_info">
                                <thead class="bg-success">
                                <tr class="text-white">
                                    <th>Nro Siniestro</th>
                                    <th>id/estado</th>
                                    <th>Usuario</th>
                                    <th>Fecha del registro</th>
                                    <th>id</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php do { ?>
                                    <tr>
                                        <td><?php echo $nro_siniestro; ?>  </td>
                                        <td><?php echo $row_hist_siniestro['id_estado']. "/". fn_nombre_estado($row_hist_siniestro['id_estado']); ?>  </td>
                                        <td><?php echo fn_nombre_usuario($row_hist_siniestro['id_usuario']); ?>  </td>
                                        <td><?php echo fn_fecha_corta($row_hist_siniestro['fecha_registro']); ?>  </td>
                                        <td><?php echo  $row_hist_siniestro['id_estado_siniestro'] ; ?>  </td>
                                    </tr>
                                <?php } while ($row_hist_siniestro = mysqli_fetch_assoc($re_hist_siniestro)); ?>
                                </tbody>
                            </table>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </section>



</div>

</section>

<section>
    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="<?php echo $_SERVER['HTTP_REFERER'];?>" class="btn btn-success" ><i class="fas fa-long-arrow-alt-left position-left"></i>
            Volver</a></p>
    </div>
</section>
</div>

<script src="c_js/vendors.bundle.js"></script>
<script src="c_js/app.bundle.js"></script>
<script>
    $(document).ready(function () {
    });
</script>
</body>
</html>