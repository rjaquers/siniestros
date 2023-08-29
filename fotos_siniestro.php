<?php

include_once("c_connections/conec6.php");
include_once("c_connections/funciones.php");

if (isset($_GET['patente'])) {
    $patente = trim(filter_input(INPUT_GET, 'patente', FILTER_SANITIZE_STRING));
    $q_fotos = sprintf(
        "SELECT `F`.`id_foto`, `F`.`id_patente`, `F`.`id_siniestro`, `F`.`url_foto`, `F`.`procesada`, `F`.`fecha_registro`,  
    `P`.`patente`,   `S`.`nro_siniestro` 
    FROM `tbl_fotos` AS `F`  
    LEFT JOIN `tbl_patentes` AS `P` ON `F`.`id_patente` = `P`.`id_patente` 
    LEFT JOIN `tbl_siniestros` AS `S` ON `F`.`id_siniestro` = `S`.`id_siniestro` 
    WHERE `P`.`patente` = '%s' 
    AND `F`.`procesada` = 1 order by  `S`.`nro_siniestro`",
        $patente
    );
    $re_fotos = mysqli_query($conec6, $q_fotos) or die(mysqli_error($conec6)." - Error 43 $q_fotos");
    $row_fotos = mysqli_fetch_assoc($re_fotos);
    $totalRows_fotos = mysqli_num_rows($re_fotos);

    $id_patente = fn_id_patente($patente);

    include_once("query/q_siniestros_listar.php");
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
                        <?php if ($totalRows_sin_x_fecha > 0) { ?>
                            <table class="table table-bordered table-hover  w-100 dataTable dtr-inline" role="grid" aria-describedby="dt-basic-example_info">
                                <thead class="bg-success">
                                <tr class="text-white">
                                    <th>Acciones</th>
                                    <th>Nro Siniestro</th>
                                    <th>Estado</th>
                                    <th>Ultima Actualización</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php do { ?>
                                    <tr>
                                        <td>
                                            <a href="historial_del_siniesto.php?id_siniestro=<?php echo $row_sin_x_fecha['id_siniestro']; ?>&nro_siniestro=<?php echo $row_sin_x_fecha['nro_siniestro']; ?>&patente=<?php echo $patente; ?>">
                                            <i class="fa fa-history"  title="Ver historial de Movimientos" data-toggle="tooltip" data-placement="top" data-original-title="Ver historial de movimientos"></i>
                                            </a>
                                        </td>
                                        <td><?php echo $row_sin_x_fecha['nro_siniestro']; ?>  </td>

                                        <td> [<?php echo $row_sin_x_fecha['id_estado'] ?>] - <?php echo $row_sin_x_fecha['nombre'] ?> /  <?php echo nl2br($row_sin_x_fecha['descripcion']); ?>  </td>
                                        <td><?php echo fn_fecha_corta($row_sin_x_fecha['fecha_actualizacion']); ?></td>
                                    </tr>
                                <?php } while ($row_sin_x_fecha = mysqli_fetch_assoc($re_sin_x_fecha)); ?>
                                </tbody>
                            </table>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </section>


        <section>

            <?php
            if ($totalRows_fotos > 0) { ?>
                <div class="panel">
                    <div class="panel-hdr">
                        <h2>
                            Total de siniestros encontrados = <?php echo $totalRows_sin_x_fecha ?> / Fotos Totales: <?php echo $totalRows_fotos; ?>
                        </h2>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <table class="table table-bordered table-hover  w-100 dataTable dtr-inline" role="grid" aria-describedby="dt-basic-example_info">
                                <thead>
                                <tr class="bg-secondary text-white">
                                    <th>Acciones</th>
                                    <th>Siniestro Asociado</th>
                                    <th>Foto</th>
                                    <th>Fecha registro</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php do { ?>
                                    <td>
                                        <a target='_blank'
                                           href='img/fotos/<?php echo $row_fotos['id_patente']."/".$row_fotos['id_siniestro']."/grandes/".$row_fotos['url_foto']; ?>'
                                           title='Abrir' data-toggle='tooltip' data-placement='top' data-original-title='Eliminar'>Ver Foto</a>
                                    </td>
                                    <td><?php echo $row_fotos['nro_siniestro']; ?></td>
                                    <td>
                                        <a target='_blank'
                                           href='img/fotos/<?php echo $row_fotos['id_patente']."/".$row_fotos['id_siniestro']."/grandes/".$row_fotos['url_foto']; ?>'>
                                            <img width='35px' height='26'
                                                 src='img/fotos/<?php echo $row_fotos['id_patente']."/".$row_fotos['id_siniestro']."/chicas/".$row_fotos['url_foto']; ?>'>
                                        </a>
                                    </td>
                                    <td><?php echo fn_fecha_corta($row_fotos['fecha_registro']); ?></td>
                                    </tr>
                                <?php } while ($row_fotos = mysqli_fetch_assoc($re_fotos)); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                    <div class="d-flex align-items-center">
                        <div class="alert-icon width-8">
                                                                            <span class="icon-stack icon-stack-xl">
                                                                               <div class="icon-stack">
                                                                                <i class="base base-7 icon-stack-3x opacity-100 color-danger-700"></i>
                                                                                   <i class="base base-7 icon-stack-2x opacity-100 color-warning-100"></i>
                                                                                   <i class="fal fa-exclamation-triangle icon-stack-1x opacity-100 color-danger-700"></i>
                                            </div>
                                                                            </span>
                        </div>
                        <div class="flex-1 pl-1">
                                                                            <span class="h2">
                                                                               No se encontraron registros
                                                                            </span>
                            <br>
                            Intente nuevamente .

                        </div>
                    </div>
                </div>
            <?php } ?>
            <!--        Fin Carrusel-->
</div>
</div>
</section>

<section>
    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
        <a href="f_login.php">
            <button type="button" class="btn btn-primary btn-lg px-4 gap-3">Ingresar al sistema</button>
        </a>
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