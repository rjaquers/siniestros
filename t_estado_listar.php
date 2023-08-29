<?php
include_once("c_connections/conec6.php");
include("query/q_estados_listar.php");
?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2> Estados <span class="fw-300"><i><?php echo $_GET['accion']; ?> </i></span></h2>

                <div class="panel-toolbar  ">
                    <div class="pull-right">
                        <a href="home_admin.php?id_estados=1&template=t_estado_crear&accion=crear&titulo_pagina=Usuarios>Crear&seccion=Usuarios&desc_pagina=Sistema de registro de nuevos usuarios">
                            <button class="btn btn-info" value="Crear Usuario"><i class="fa fa-user-plus"></i> Estados Crear</button>
                        </a>
                    </div>
                    <?php include_once("inc_balls.inc"); ?>
                </div>

            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?php
                    if ($totalRows_estados > 0) { ?>
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" role="grid"
                               aria-describedby="dt-basic-example_info">
                            <thead>
                            <tr class="bg-secondary text-white">
                                <th>Acciones</th>
                                <th>id/estado</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Fecha registro</th>
                                <th>Fecha actualización</th>
                                <th>Activo</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php do { ?>
                            <tr>
                                <td>
                                    <a href="home_admin.php?id_estado=<?php echo $row_estados['id_estado']; ?>&accion=editar&template=t_estado_editar&titulo_pagina=Administración>Estados&seccion=Administracion&desc_pagina=Editar estados del sistema"
                                       title='Editar' data-toggle='tooltip' data-placement='top' data-original-title='Editar'>
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                                <td><?php echo $row_estados['id_estado']; ?> </td>
                                <td><?php echo $row_estados['nombre']; ?> </td>
                                <td><?php echo $row_estados['descripcion'] ?></td>
                                <td><?php echo $row_estados['fecha_registro']; ?></td>
                                <td><?php echo $row_estados['fecha_actualizacion']; ?></td>
                                <td><?php echo $row_estados['activo'] ?></td>
                            </tr>


                            </tbody>
                            <?php } while ($row_estados = mysqli_fetch_assoc($re_estados)); ?>
                            <tfood>
                                <tr>
                                    <td colspan="9">Estados de los autos que llegan al taller
                                    </td>

                                </tr>
                            </tfood>

                        </table>
                    <?php }  else {  include ("inc_solicita_soporte.php"); } ?>
            </div>
        </div>
    </div>
</div>


