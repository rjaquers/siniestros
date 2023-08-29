<?php
if (isset($_GET['patente'])) {
    $patente = trim(filter_input(INPUT_GET, 'patente', FILTER_SANITIZE_STRING));
    include_once("c_connections/conec6.php");

    $q_patente = sprintf( "SELECT `P`.`id_patente`, `P`.`patente`, `P`.`fecha_registro`, `P`.`fecha_actualizacion`, `P`.`activo`, `P`.`id_usuario`, `S`.`id_siniestro`, `S`.`nro_siniestro`, `S`.`id_patente`, `S`.`activo`, `S`.`id_usuario` 
                    FROM `tbl_patentes` as P LEFT JOIN `tbl_siniestros` AS S on `P`.`id_patente` = `S`.`id_patente` 
                    WHERE `P`.`patente` = '%s' and `P`.`activo` = 1   ", $patente);
    $re_patente = mysqli_query($conec6, $q_patente) or die(mysqli_error($conec6)." - Error 43 $q_patente");
    $row_patente = mysqli_fetch_assoc($re_patente);
    $totalRows_patente = mysqli_num_rows($re_patente);

}
?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2> Siniestro > Fotos: <?php echo strtoupper($_GET['patente']); ?> / <span class="fw-300"><i><?php echo $_GET['accion']; ?>  </i></span></h2>

                <div class="panel-toolbar  ">
                    <?php include_once("inc_balls.inc"); ?>
                </div>

            </div>
            <div class="panel-container show">
                <div class="panel-content">
                     <?php if($totalRows_patente>0) {  ?>

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


                        <tr>
                            <td>
                                <a href='<?php echo $_SESSION['home']; ?>?id_siniestro=<?php echo $row_patente['id_siniestro']; ?>&id_patente=<?php echo $row_patente['id_patente']; ?>&patente=<?php echo $patente; ?>&accion=ver&template=t_fotos_listar&titulo_pagina=Ver Fotos &seccion=Administracion&desc_pagina=Ver Fotos Siniestros' title='Ver' data-toggle='tooltip' data-placement='top'
                                data-original-title='Editar'> Fotos</a> |
                                <a href='<?php echo $_SESSION['home']; ?>?id_siniestro=<?php echo $row_patente['id_siniestro']; ?>&id_patente=<?php echo $row_patente['id_patente']; ?>&patente=<?php echo $patente; ?>&accion=ver&template=t_fotos_zipo&titulo_pagina=Bajar Fotos &seccion=Administracion&desc_pagina=Ver Fotos Siniestros' title='Ver' data-toggle='tooltip' data-placement='top' data-original-title='Editar'> Bajar Zip</a> |

                                <?php if($_SESSION['id_perfil'] == 1) { ?>
                                <a href='<?php echo $_SESSION['home']; ?>?id_siniestro=<?php echo $row_patente['id_siniestro']; ?>&id_patente=<?php echo $row_patente['id_patente']; ?>&accion=borrar&template=t_patente_eliminar&titulo_pagina=Siniestros
                                > Eliminar &seccion=Administracion&desc_pagina=Eliminar usuarios del sistema' title='Eliminar' data-toggle='tooltip' data-placement='top'
                                data-original-title='Eliminar'> Eli</a>
                                <?php } ?>

                            </td>

                            <td> <?php echo $row_patente['nro_siniestro']; ?> </td>
                            <td>  <?php echo $patente; ?> </td>

                            <td><?php echo $row_patente['fecha_registro']; ?></td>
                            <td><?php echo $row_patente['fecha_actualizacion']; ?></td>
                            <td><?php echo $row_patente['activo']; ?></td>
                            <td><?php echo fn_nombre_usuario($row_patente['id_usuario']); ?></td>
                            <td><?php echo $row_patente['id_siniestro']; ?> </td>
                        </tr>
                        </tbody>
                        <tfood>
                            <tr>
                                <td colspan="9">

                                </td>

                            </tr>
                        </tfood>
                    </table>

                    <?php } else { ?>

                    <div class="panel-tag bg-warning">
                        Resultado de la consulta: No hay registros de siniestros para esta patente, Desea


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





