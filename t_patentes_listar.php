<?php include_once("c_connections/conec6.php"); ?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2> Siniestros <span class="fw-300"><i><?php echo $_GET['accion']; ?> </i></span></h2>

                <div class="panel-toolbar  ">
                    <div class="pull-right">
                        <a href="home_admin.php?id_usuario=1&template=t_patente_crear&accion=crear&titulo_pagina=Usuarios>Crear&seccion=Usuarios&desc_pagina=Sistema de registro de nuevas patentes">
                            <button class="btn btn-info" value="Crear Patente"><i class="fa fa-car"></i> Registrar Patente</button>
                        </a>
                    </div>
                    <?php include_once("inc_balls.inc"); ?>
                </div>

            </div>
            <div class="panel-container show">
                <div class="panel-content">

                    <?php

                    $q_patente = "SELECT * FROM `tbl_patentes` WHERE `activo` = 1 ORDER BY `fecha_registro` DESC  LIMIT 1000";

                    if (!empty($conec6)) {
                        $re_patente = mysqli_query($conec6, $q_patente) or die(mysqli_error($conec6)." - Error 43 $q_patente");
                    }
                    $row_patente = mysqli_fetch_assoc($re_patente);
                    $totalRows_patente = mysqli_num_rows($re_patente);
                    if ($totalRows_patente > 0) { ?>
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" role="grid"  aria-describedby="dt-basic-example_info">
                            <thead>
                            <tr class="bg-secondary text-white">
                                <th>Acciones</th>
                                <th>id</th>
                                <th>patente</th>

                                <th>Registrado por</th>
                                <th>Fecha registro</th>
                                <th>Fecha actualización</th>
                                <th>Activo</th>
                                <th>usuario</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php do { ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo $_SESSION['home']; ?>?template=t_siniestros_listar&id_patente=<?php echo $row_patente['id_patente']; ?>&patente=<?php echo $row_patente['patente']; ?>&accion=ver&&titulo_pagina=Patentes > Ver Siniestros&seccion=Administracion&desc_pagina=Ver siniestros de la patente" title='Siniestros de la patente' data-toggle='tooltip' data-placement='top' data-original-title='Siniestros' > <i class="fa-solid fa-car-burst"></i></a> |
                                        <a href="<?php echo $_SESSION['home']; ?>?template=t_patente_editar&id_patente=<?php echo $row_patente['id_patente']; ?>&patente=<?php echo $row_patente['patente']; ?>&accion=editar&&titulo_pagina=Patentes > Editar &seccion=Administracion&desc_pagina=Modificar datos de la patente" title='Patente editar' data-toggle='tooltip' data-placement='top' data-original-title='Modificar'> <i class="fa-brands fa-product-hunt"></i></a> |
                                        <a href="<?php echo $_SESSION['home']; ?>?template=t_asegurado_editar&id_patente=<?php echo $row_patente['id_patente']; ?>&patente=<?php echo $row_patente['patente']; ?>&accion=editar&&titulo_pagina=Asegurado > Editar &seccion=Administracion&desc_pagina=Modificar datos de la patente" title='Asegurado Editar' data-toggle='tooltip' data-placement='top' data-original-title='Modificar'> <i class="fa-solid fa-user-injured"></i></a> |
                                        <a href="<?php echo $_SESSION['home']; ?>?template=t_patente_eliminar&id_patente=<?php echo $row_patente['id_patente']; ?>&patente=<?php echo $row_patente['patente']; ?>&accion=borrar&&titulo_pagina=Patentes > Eliminar&seccion=Administracion&desc_pagina=Eliminar datos de la patente" title='Eliminar datos de la patente' data-toggle='tooltip' data-placement='top' data-original-title='Eliminar'> <i class="fa-solid fa-trash-can"></i></a> |
                                        <a href="librerias/phpqrcode/patente.php?patente=&patente=<?php echo $row_patente['patente']; ?>" target="_blank"  title='QR Patente Imrimir ' data-toggle='tooltip' data-placement='top' data-original-title='Eliminar'> <i class="fa fa-qrcode "></i></a>
                                    </td>

                                    <td><?php echo $row_patente['id_patente']; ?></td>
                                    <td><?php echo strtoupper($row_patente['patente']); ?> </td>

                                    <td><?php echo fn_nombre_usuario($row_patente['id_usuario']); ?></td>
                                    <td><?php echo $row_patente['fecha_registro']; ?></td>
                                    <td><?php echo $row_patente['fecha_actualizacion']; ?></td>
                                    <td><?php echo $row_patente['activo']; ?></td>
                                    <td><?php echo $row_patente['id_usuario']; ?></td>
                                </tr>


                            <?php } while ($row_patente = mysqli_fetch_assoc($re_patente)); ?>


                            </tbody>
                            <tfood>
                                <tr>
                                    <td colspan="9">

                                    </td>

                                </tr>
                            </tfood>
                        </table>
                    <?php }  else {  include ("inc_solicita_soporte.php"); } ?>
            </div>
        </div>
    </div>
</div>


