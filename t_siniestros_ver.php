<?php include_once("c_connections/conec7.php");
if (isset($_GET['patente'])) {
    $patente = trim(filter_input(INPUT_GET, 'patente', FILTER_SANITIZE_STRING));
} else {
    $patente = fn_patente_x_id($id_patente);
}
if (isset($_GET['id_patente'])) {
    $id_patente = trim(filter_input(INPUT_GET, 'id_patente', FILTER_SANITIZE_STRING));
} else {
    $id_patente = fn_id_patente($_GET['patente']);
}
?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2> Siniestro > Fotos: <?php echo strtoupper($_GET['patente']); ?> / <span class="fw-300"><i><?php echo $_GET['accion']; ?>  </i></span></h2>
                <div class="panel-toolbar">
                    <div class="pull-right">
                        <a href="<?php echo $_SESSION['home']; ?>?id_patente=<?php echo $id_patente; ?>&patente=<?php echo $patente; ?>&template=t_siniestro_crear&accion=crear&titulo_pagina=Siniestro>Crear&seccion=Siniestros&desc_pagina=Sistema de registro de nuevos Siniestros por patente">
                            <button class="btn btn-info" value="Siniestro Crear"><i class="fa fa-car-burst"></i> Registrar Nuevo Siniestro</button>
                        </a>
                    </div>
                    <?php include_once("inc_balls.inc"); ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?php
                    if (! empty($conec6)) {
                        $q_sin_x_fecha = sprintf("SELECT *  FROM `tbl_siniestros` WHERE `id_patente` = %d AND `activo` = 1 ORDER BY `fecha_registro` DESC LIMIT 1000", $id_patente);
                        $re_sin_x_fecha = mysqli_query($conec6, $q_sin_x_fecha) or die(mysqli_error($conec6)." - Error 43 $q_sin_x_fecha");
                        $row_sin_x_fecha = mysqli_fetch_assoc($re_sin_x_fecha);
                        $totalRows_sin_x_fecha = mysqli_num_rows($re_sin_x_fecha);
                    }; ?>
                    <?php if ($totalRows_sin_x_fecha > 0) { ?>
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" role="grid"
                               aria-describedby="dt-basic-example_info">
                            <thead>
                            <tr class="bg-primary text-white">
                                <th>Acciones</th>
                                <th>Nro Siniestro</th>
                                <th>patente</th>
                                <th>Fecha registro</th>
                                <th>Fecha actualización</th>
                                <th>Activo</th>
                                <th>Usuario</th>
                                <th>id/Siniestro</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php do { ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo $_SESSION['home']; ?>?id_siniestro=<?php echo $row_sin_x_fecha['id_siniestro']; ?>&id_patente=<?php echo $row_sin_x_fecha['id_patente']; ?>&patente=<?php echo $patente; ?>&accion=ver&template=t_fotos_listar&titulo_pagina= > Ver Fotos &seccion=Administracion&desc_pagina=Ver Fotos Siniestros" title="Ver" data-toggle="tooltip" data-placement="top" data-original-title="Editar"> Fotos</a> |
                                        <a href="<?php echo $_SESSION['home']; ?>?id_siniestro=<?php echo $row_sin_x_fecha['id_siniestro']; ?>&id_patente=<?php echo $row_sin_x_fecha['id_patente']; ?>&patente=<?php echo $patente; ?>&accion=ver&template=t_fotos_zipo&titulo_pagina= > Bajar Fotos &seccion=Administracion&desc_pagina=Ver Fotos Siniestros" title="Ver" data-toggle="tooltip" data-placement="top" data-original-title="Editar"> Bajar Zip</a> |
                                        <a href="<?php echo $_SESSION['home']; ?>?id_siniestro=<?php echo $row_sin_x_fecha['id_siniestro']; ?>&id_patente=<?php echo $row_sin_x_fecha['id_patente']; ?>&accion=borrar&template=t_patente_eliminar&titulo_pagina=Siniestros > Eliminar &seccion=Administracion&desc_pagina=Eliminar usuarios del sistema" title="Eliminar" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar"> Eli</a>
                                    </td>
                                    <td><?php echo $row_sin_x_fecha['nro_siniestro']; ?>  </td>
                                    <td><?php echo $patente; ?></td>
                                    <td><?php echo $row_sin_x_fecha['fecha_registro']; ?></td>
                                    <td><?php echo $row_sin_x_fecha['fecha_actualizacion']; ?></td>
                                    <td><?php echo $row_sin_x_fecha['activo']; ?></td>
                                    <td><?php echo fn_nombre_usuario($row_sin_x_fecha['id_usuario']); ?></td>
                                    <td><?php echo $row_sin_x_fecha['id_siniestro']; ?></td>
                                </tr>
                            <?php } while ($row_sin_x_fecha = mysqli_fetch_assoc($re_sin_x_fecha)); ?>
                            </tbody>
                        </table>
                    <?php }  else { ?>
                    <div class="panel-tag bg-warning">
                        Resultado de la consulta: No hay registros de siniestros para esta patente, Desea

                        <a href="home_admin.php?id_patente=<?php echo $id_patente; ?>&patente=<?php echo $patente; ?>&template=t_siniestro_crear&accion=crear&titulo_pagina=Siniestro>Crear&seccion=Siniestros&desc_pagina=Sistema de registro de nuevos Siniestros por patente"
                           class="btn btn-info btn-xs"> <i class="fa fa-car-burst"></i> Registrar un nuevo Siniestro </a>
                    </div>
                    Si cree que hay un error, informe a soporte
                    <a target="_blank" href="https://api.whatsapp.com/send?phone=56961405440&text=Hola,%20Necesito%20soporte%20Sistema%20Foto%20Siniestros%20HyV">Solicitar Soporte
                        aquí</a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>