<?php include_once("c_connections/conec7.php"); ?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2> Usuarios <span class="fw-300"><i><?php echo $_GET['accion']; ?> </i></span></h2>

                <div class="panel-toolbar  ">
                    <div class="pull-right">
                        <a href="home_admin.php?id_estados=1&template=t_estadoss_crear&accion=crear&titulo_pagina=Usuarios>Crear&seccion=Usuarios&desc_pagina=Sistema de registro de nuevos usuarios">
                            <button class="btn btn-info" value="Crear Usuario"><i class="fa fa-user-plus"></i> Usuarios Crear</button>
                        </a>
                    </div>
                    <?php include_once("inc_balls.inc"); ?>
                </div>

            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?php

                    $q_estados = sprintf("select * from `tbl_estados`  WHERE `activo` = %d ORDER BY  `id_estado` DESC limit 200", 1);

                    $re_estados = mysqli_query($conec6, $q_estados) or die(mysqli_error($conec6)." - Error 43 $q_estados");
                    $row_estados = mysqli_fetch_assoc($re_estados);
                    $totalRows_estados = mysqli_num_rows($re_estados);
                    if ($totalRows_estados > 0) { ?>
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" role="grid"
                               aria-describedby="dt-basic-example_info">
                            <thead>
                            <tr class="bg-secondary text-white">
                                <th>Acciones</th>
                                <th>id/estado</th>
                                <th>Nombre </th>
                                <th>descripcion </th>
                                <th>fecha_registro</th>
                                <th>Fecha actualización</th>
                                <th>Activo</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php do { ?>

                            <tr>
                                <td>
                                    <a href="home_admin.php?id_estados=<?php echo $row_estados['id_estados'] ?>&accion=editar&template=t_estados_editar&titulo_pagina=Administración>Usuarios&seccion=Administracion&desc_pagina=Editar usuarios del sistema"
                                       title='Modificar' data-toggle='tooltip' data-placement='top' data-original-title='Editar'> Editar</a> |
                                    <a href='home_admin.php?id_estados=<?php echo $row_estados['id_estados'] ?>&accion=borrar&template=t_estados_eliminar&titulo_pagina=Administración>Usuarios&seccion=Administracion&desc_pagina=Eliminar usuarios del sistema'
                                       title='Eliminar' data-toggle='tooltip' data-placement='top' data-original-title='Eliminar'> Eliminar</a>
                                </td>
                                <td><?php echo $row_estados['id_estados']; ?> </td>
                                <td><?php echo $row_estados['nombre']; ?> </td>
                                <td><?php echo $row_estados['descripcion'] ?></td>
                                <td><?php echo $row_estados['fecha_registro']; ?></td>
                                <td><?php echo $row_estados['fecha_actualizacion']; ?></td>
                                <td><?php echo $row_estados['activo'] ?></td>
                            </tr>


                            </tbody>
                            <?php } while ($row_estados = mysqli_fetch_assoc($re_estados)); ?>

                        </table>
                    <?php }  else { ?>
                    <div class="panel-tag">
                        Resultado de la consulta: No hay registros,
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


