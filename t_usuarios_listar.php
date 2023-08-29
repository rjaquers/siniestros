<?php include_once("c_connections/conec7.php"); ?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2> Usuarios <span class="fw-300"><i><?php echo $_GET['accion']; ?> </i></span></h2>

                <div class="panel-toolbar  ">
                    <div class="pull-right">
                        <a href="home_admin.php?id_usuario=1&template=t_usuarios_crear&accion=crear&titulo_pagina=Usuarios>Crear&seccion=Usuarios&desc_pagina=Sistema de registro de nuevos usuarios">
                            <button class="btn btn-info" value="Crear Usuario"><i class="fa fa-user-plus"></i> Usuarios Crear</button>
                        </a>
                    </div>
                    <?php include_once("inc_balls.inc"); ?>
                </div>

            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <?php

                    $q_usuario = sprintf("select * from `tbl_usuarios`  WHERE `activo` = %d ORDER BY  `id_usuario` DESC limit 200", 1);

                    $re_usuario = mysqli_query($conec6, $q_usuario) or die(mysqli_error($conec6)." - Error 43 $q_usuario");
                    $row_usuario = mysqli_fetch_assoc($re_usuario);
                    $totalRows_usuario = mysqli_num_rows($re_usuario);
                    if ($totalRows_usuario > 0) { ?>
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" role="grid"
                               aria-describedby="dt-basic-example_info">
                            <thead>
                            <tr class="bg-secondary text-white">
                                <th>Acciones</th>
                                <th>id/usuario</th>
                                <th>Perfil</th>
                                <th>Nombres</th>
                                <th>Correo/Usuario</th>
                                <th>Clave Encriptada</th>
                                <th>Fecha registro</th>
                                <th>Fecha actualización</th>
                                <th>Activo</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php do { ?>

                            <tr>
                                <td>
                                    <a href="home_admin.php?id_usuario=<?php echo $row_usuario['id_usuario'] ?>&accion=editar&template=t_usuarios_editar&titulo_pagina=Administración>Usuarios&seccion=Administracion&desc_pagina=Editar usuarios del sistema"
                                       title='Modificar' data-toggle='tooltip' data-placement='top' data-original-title='Editar'> Editar</a> |
                                    <a href='home_admin.php?id_usuario=<?php echo $row_usuario['id_usuario'] ?>&accion=borrar&template=t_usuarios_eliminar&titulo_pagina=Administración>Usuarios&seccion=Administracion&desc_pagina=Eliminar usuarios del sistema'
                                       title='Eliminar' data-toggle='tooltip' data-placement='top' data-original-title='Eliminar'> Eliminar</a>
                                </td>
                                <td><?php echo $row_usuario['id_usuario']; ?> </td>
                                <td>[<?php echo $row_usuario['id_perfil']; ?>] <?php echo fn_nombre_perfil($row_usuario['id_perfil']) ?> </td>
                                <td><?php echo $row_usuario['nombres_usuario'] ?></td>
                                <td><?php echo $row_usuario['correo_usuario'] ?></td>
                                <td> *************</td>
                                <td><?php echo $row_usuario['fecha_registro']; ?></td>
                                <td><?php echo $row_usuario['fecha_actualizacion']; ?></td>
                                <td><?php echo $row_usuario['activo'] ?></td>
                            </tr>


                            </tbody>
                            <?php } while ($row_usuario = mysqli_fetch_assoc($re_usuario)); ?>

                        </table>
                    <?php }  else {  include ("inc_solicita_soporte.php"); } ?>
            </div>
        </div>
    </div>
</div>


