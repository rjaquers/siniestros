<?php

include("query/q_siniestros_listar.php");
include("query/q_estados_listar.php");

// Crear la estructura de un select para solo pedirla una vez por cada listado de patentes.
//Se usa más abajo en el selectt de cada patente.
//$varselect = '';
//do {
//    $varselect .= "<option value='".$row_estados['id_estado']."'>".$row_estados['id_estado'] ."=".$row_estados['nombre']." </option>";
//} while ($row_estados = mysqli_fetch_assoc($re_estados));
//?>


    <div class="row">
        <div class="col-xl-12">
            <div id="panel-1" class="panel">
                <div class="panel-hdr">
                    <h2> Siniestro > Listar: / <span class="fw-300"><i><?php echo $_GET['accion']; ?>  </i></span></h2>
                    <div class="panel-toolbar">
                        <div class="pull-right">
                           <a href="<?php echo $_SESSION['home']; ?>?template=t_siniestro_crear&accion=crear&titulo_pagina=Siniestro>Crear&seccion=Siniestros&desc_pagina=Sistema de registro de nuevos Siniestros por patente">
                            <button class="btn btn-info" value="Siniestro Crear"><i class="fa fa-car-burst"></i> Registrar Nuevo Siniestro</button>
                             </a>
                        </div>
                        <?php include_once("inc_balls.inc"); ?>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">

                        <form action="home_admin.php" name="formulario100" method="get" enctype="multipart/form-data">
                            <div class="row">
                                <div class=" col-md-3">
                                </div>
                                <div class=" col-md-6">
                                    <input id="campo"  name="nro_siniestro" type="text"   placeholder="Buscar por número de siniestro" class="input-md form-control" required >
                                <input id="boton" name="boton" type="submit" class="input-md btn-secondary" value="Buscar" disabled>
                                <input type="hidden" name="id_formulario" value="100">
                                <input type="hidden" name="template" value="t_siniestros_listar">
                                <input type="hidden" name="accion" value="buscar nro sinietro">
                                <input type="hidden" name="titulo_pagina" value="Buscar siniestros">
                                <input type="hidden" name="seccion" value="Administración">
                                <input type="hidden" name="desc_pagina" value="Panel de Estados de siniestros">
                                </div>
                            </div>
                        </form>





                        <hr>

                        <?php if ($totalRows_siniestro > 0) { ?>
                            <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" role="grid"
                                   aria-describedby="dt-basic-example_info">
                                <thead>
                                <tr class="bg-primary text-white">
                                    <th>Acciones</th>
                                    <th>ID/</th>
                                    <th>Nro. Siniestro</th>
                                    <th>patente</th>
                                    <th>Estado</th>
                                    <th>Fecha registro</th>
                                    <th>Activo</th>
                                    <th>Usuario</th>

                                </tr>
                                </thead>
                                <tbody>

                                <?php do { ?>
                                    <tr>
                                        <td>
                                                                                    <a href="<?php echo $_SESSION['home']; ?>?id_siniestro=
                                            <?php echo $row_siniestro['id_siniestro']; ?>&id_patente=<?php echo $row_siniestro['id_patente']; ?>&patente=
                                            <?php echo $row_siniestro['patente']; ?>&accion=ver&template=t_fotos_listar&titulo_pagina= > Ver Fotos &seccion=Administracion&desc_pagina=Ver Fotos Siniestros"
                                                                                       title="Ver foto Siniestro" data-toggle="tooltip" data-placement="top" data-original-title="Editar"> <i class="fa-solid fa-images"></i></a> |
                                                                                    <a href="<?php echo $_SESSION['home']; ?>?id_siniestro=
                                            <?php echo $row_siniestro['id_siniestro']; ?>&id_patente=<?php echo $row_siniestro['id_patente']; ?>&patente=
                                            <?php echo $row_siniestro['patente']; ?>&accion=ver&template=t_fotos_zipo&titulo_pagina= > Bajar Fotos &seccion=Administracion&desc_pagina=Bajar Zip de fotos"
                                                                                       title="Bajar Zip de fotos" data-toggle="tooltip" data-placement="top" data-original-title="Editar"> <i class="fa-solid fa-file-zipper"></i> </a> |
                                                                                    <a href="<?php echo $_SESSION['home']; ?>?id_siniestro=
                                            <?php echo $row_siniestro['id_siniestro']; ?>&id_patente=
                                            <?php echo $row_siniestro['id_patente']; ?>&accion=borrar&template=t_patente_eliminar&titulo_pagina=Siniestros > Eliminar &seccion=Administracion&desc_pagina=Eliminar fotos del sistema"
                                                                                       title="Eliminar" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar"><i class="fa fa-trash"></i>  </a> |
                                                                                    <a href="historial_del_siniesto.php?id_siniestro=
                                            <?php echo $row_siniestro['id_siniestro']; ?>&nro_siniestro=<?php echo $row_siniestro['nro_siniestro']; ?>&patente=
                                            <?php echo $row_siniestro['patente']; ?>" target="_blank"
                                                                                       title="Historial del siniestro" data-toggle="tooltip" data-placement="top" data-original-title="Eliminar"> <i class="fa fa-history"></i> </a>
                                        </td>

                                        <td><?php echo $row_siniestro['id_siniestro']; ?>  </td>
                                        <td><?php echo $row_siniestro['nro_siniestro']; ?>  </td>
                                        <td title="id_patente: <?php echo $row_siniestro['id_patente']; ?>"><?php echo $row_siniestro['patente']; ?></td>

                                        <td>
                                       <span id="descripcion_<?php echo $row_siniestro['id_siniestro'] ?>">
                                        <a href="#" title="<?php echo $row_siniestro['descripcion']; ?>" data-toggle="tooltip" data-placement="top"
                                           data-original-title="<?php echo $row_siniestro['descripcion'] ?>">
                                             [<?php echo $row_siniestro['id_estado']; ?>] </a>
                                        </span>
                                        </td>


                                        <td><?php echo $row_siniestro['fecha_registro']; ?></td>

                                        <td><?php echo $row_siniestro['activo']; ?></td>
                                        <td><?php echo $row_siniestro['id_usuario']; ?></td>

                                    </tr>
                                <?php } while ($row_siniestro = mysqli_fetch_assoc($re_siniestro)); ?>
                                </tbody>
                            </table>
                        <?php }  else { ?>
                        <div class="panel-tag bg-warning">
                            Resultado de la consulta: No hay registros de siniestros para esta patente, Desea

                            <a href="home_admin.php?id_patente=<?php echo $id_patente; ?>&patente=<?php echo $patente; ?>&template=t_siniestro_crear&accion=crear&titulo_pagina=Siniestro>Crear&seccion=Siniestros&desc_pagina=Sistema de registro de nuevos Siniestros por patente"
                               class="btn btn-info btn-xs"> <i class="fa fa-car-burst"></i> Registrar un nuevo Siniestro </a>
                        </div>
                        Si cree que hay un error, informe a soporte
                        <a target="_blank" href="https://api.whatsapp.com/send?phone=56961405440&text=Hola,%20Necesito%20soporte%20Sistema%20Foto%20Siniestros%20HyV">Solicitar
                            Soporte
                            aquí</a>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <script>document.addEventListener('DOMContentLoaded', () => {
            const campoInput = document.getElementById('campo');
            const botonEnviar = document.getElementById('boton');

            campoInput.addEventListener('input', () => {
                if (campoInput.value.trim() !== '') {
                    botonEnviar.removeAttribute('disabled');
                    botonEnviar.classList.remove('btn-secondary');
                    botonEnviar.classList.add('btn-success');
                } else {
                    botonEnviar.setAttribute('disabled', 'true');
                    botonEnviar.classList.remove('btn-success');
                    botonEnviar.classList.add('btn-secondary');
                }
            });
        });
    </script>
<?php
//echo $q_siniestro;
mysqli_free_result($re_siniestro); ?>