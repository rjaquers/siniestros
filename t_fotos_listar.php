<?php include_once("c_connections/conec7.php");
include_once("c_connections/conec7.php");
if (isset($_GET['id_siniestro'])) {
    $id_siniestro = trim(filter_input(INPUT_GET, 'id_siniestro', FILTER_SANITIZE_NUMBER_INT));
    $nro_siniestro = fn_nro_siniestro($id_siniestro);
    $id_patente = trim(filter_input(INPUT_GET, 'id_patente', FILTER_SANITIZE_NUMBER_INT));
    $patente = trim(filter_input(INPUT_GET, 'patente', FILTER_SANITIZE_STRING));

}
?>
<div class="row">
    <div class="col-xl-12">

<!--        Subir Fotos-->
        <div id="panel-2" class="panel">
            <div class="panel-hdr">
                <h2>
                    Panel <span class="fw-300"><i> de control</i></span>
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="panel-tag">
                        <form action="query/q_fotos_subir.php" name="form1" enctype="multipart/form-data" accept-charset="UTF-8" method="post"  >
                            <label for="archivo">Adjunte Fotos </label>
                            <input type="file" name="file[]" id="file[]" class="btn btn-info" multiple accept=".jpg, .jpeg, .png" onchange="validateFileType()"/>
                            <input type="submit" name="button" id="button" value="Subir" class="btn-success">
                            <input type="hidden" name="id_patente" value="<?php if (isset($id_patente)) {  echo $id_patente;  } ?>">
                            <input type="hidden" name="patente" value="<?php if (isset($patente)) {  echo $patente;  } ?>">
                            <input type="hidden" name="id_siniestro" value="<?php echo $id_siniestro; ?>">
                            <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
                            <input type="hidden" name="id_formulario" value="107">
                        </form>
                    </div>

                </div>
            </div>
        </div>
<!-- Fin subir fotos-->

<!--Carrusel-->
        <?php
        include_once("query/q_fotos_siniestro_x_id.php");
        if ($totalRows_fotos_carr > 0 ) {   ?>
        <?php echo "Patente : <b class='color-danger-500'>". strtoupper($patente) ."</b> / Nro Siniestro: ". $nro_siniestro ?>

        <div id="panel-3" class="panel">
            <div class="panel-hdr">
                <h2>
                   Carrusel de Fotos
                </h2>
                <div class="panel-toolbar">
                    <button class="btn btn-panel waves-effect waves-themed" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                    <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                    <button class="btn btn-panel waves-effect waves-themed" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                 </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    <div class="panel-tag">


                    </div>
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">

                            <?php
                            $i = 1;
                            do { ?>
                            <div class="carousel-item  <?php if ($i == 1 ) { echo "active";  } ?>" >
                                <img class="d-block w-100" title="<?php echo $row_fotos_carr['id_foto'];?> / Fecha: <?php echo $row_fotos_carr['fecha_registro'];?>"  src="img/fotos/<?php echo $row_fotos_carr['id_patente'];?>/<?php echo $row_fotos_carr['id_siniestro'];?>/grandes/<?php echo $row_fotos_carr['url_foto'];?>" data-src="holder.js/400x300?auto=yes&amp;bg=fe85be&amp;fg=ffffff&amp;text=<?php echo $row_fotos_carr['id_foto'];?>" alt="Fecha Registro: <?php echo $row_fotos_carr['fecha_registro'];?>"  >
                            </div>
                            <?php $i++; } while ($row_fotos_carr = mysqli_fetch_assoc($re_fotos_carr)); ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
<!--        Fin Carrusel-->



<!--Listado de fotos-->
        <?php
        $q_fotos_carr2 = sprintf("SELECT *   FROM `tbl_fotos` WHERE `activo` = 1 AND  `id_siniestro` = %d ORDER BY `fecha_registro` ASC" , $id_siniestro);
        $re_fotos_carr2 = mysqli_query($conec6, $q_fotos_carr2) or die(mysqli_error($conec6) . " - Error 200 $q_fotos_carr2");
        $row_fotos_carr2 = mysqli_fetch_assoc($re_fotos_carr2);
        $totalRows_fotos_carr2 = mysqli_num_rows($re_fotos_carr2);
        if ($totalRows_fotos_carr2 > 0 ) {   ?>


        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>  Siniestro Nro <?php echo $nro_siniestro ." / ID: ".$id_siniestro;  ?><span class="fw-300"><i>Accicón: <?php echo $_GET['accion']; ?> Fotos </i></span></h2>
                <div class="panel-toolbar  ">
                    <?php include_once("inc_balls.inc"); ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                        <table id="dt-basic-example" class="table table-bordered table-hover table-striped w-100 dataTable dtr-inline" role="grid"
                               aria-describedby="dt-basic-example_info">
                            <thead>
                            <tr class="bg-secondary text-white">
                                <th>Acciones</th>
                                <th>Siniestro</th>
                                <th>Patente</th>
                                <th>Url Foto</th>
                                <th>Fecha registro</th>
                                <th>Fecha actualización</th>
                                <th>Activo</th>
                                <th>Usuario</th>
                                <th>id/foto  </th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            do {
                                if ($row_fotos_carr2['procesada'] == 1) {
                                    $celda =  " <tr style='background-color: #00b767' >";
                                    $celda .= "<td><a target='_blank'   href='img/fotos/".$row_fotos_carr2['id_patente']."/".$row_fotos_carr2['id_siniestro']."/grandes/".$row_fotos_carr2['url_foto']."' title='Abrir' data-toggle='tooltip' data-placement='top'   data-original-title='Eliminar'>Abrir</a>";

                                } else {
                                    $celda =  "<tr>";
                                    $celda .= "<td><a target='_blank'   href='img/fotos/".$row_fotos_carr2['id_patente']."/".$row_fotos_carr2['id_siniestro']."/originales/".$row_fotos_carr2['url_foto']."' title='Abrir' data-toggle='tooltip' data-placement='top'   data-original-title='Eliminar'>Abrir</a>";
                                }

                                $celda .= " | <a href='query/q_fotos_procesar.php?id_foto=".$row_fotos_carr2['id_foto']."&patente=".$patente."&id_patente=".$row_fotos_carr2['id_patente']."&id_siniestro=".$row_fotos_carr2['id_siniestro']."&url_foto=".$row_fotos_carr2['url_foto']."' title='Abrir' data-toggle='tooltip' data-placement='top'   data-original-title='Eliminar'>Procesar</a>";
                                $celda .= " | <a href='".$_SESSION['home']."?id_foto=".$row_fotos_carr2['id_foto']."&patente=".$patente."&accion=borrar&template=t_fotos_eliminar&titulo_pagina=Patentes > Siniestros > Fotos Eliminar &seccion=Administracion&desc_pagina=Eliminar fotos del sistema' title='Eliminar' data-toggle='tooltip' data-placement='top'   data-original-title='Eliminar'> Eli</a> ";
                                $celda .= "</td>";
                                $celda .= "<td>".$nro_siniestro."</td>";
                                $celda .= "<td>  ".strtoupper($patente)." </td>";

                            if ($row_fotos_carr2['procesada'] == 1) {
                                $celda .= "<td><a target='_blank' href='img/fotos/".$row_fotos_carr2['id_patente']."/".$row_fotos_carr2['id_siniestro']."/grandes/".$row_fotos_carr2['url_foto']." '> ";
                                $celda .= "<img width='35px' height='26' src='img/fotos/".$row_fotos_carr2['id_patente']."/".$row_fotos_carr2['id_siniestro']."/chicas/".$row_fotos_carr2['url_foto']."'></a> </td>";
                            } else
                            {
                                $celda .= "<td><a target='_blank' href='img/fotos/".$row_fotos_carr2['id_patente']."/".$row_fotos_carr2['id_siniestro']."/originales/".$row_fotos_carr2['url_foto']." '> ";
                                $celda .= "<img width='35px' height='26' src='img/fotos/".$row_fotos_carr2['id_patente']."/".$row_fotos_carr2['id_siniestro']."/chicas/".$row_fotos_carr2['url_foto']."'></a> </td>";

                            }


                                $celda .= "<td>".$row_fotos_carr2['fecha_registro']."</td>";
                                $celda .= "<td>".$row_fotos_carr2['fecha_actualizacion']."</td>";
                                $celda .= "<td>".$row_fotos_carr2['activo']."</td>";
                                $celda .= "<td>".fn_nombre_usuario($row_fotos_carr2['id_usuario'])."</td>";
                                $celda .= "<td>".$row_fotos_carr2['id_foto']."</td>";
                                $celda .= "</tr>";
                                echo $celda;
                              } while ($row_fotos_carr2 = mysqli_fetch_assoc($re_fotos_carr2)); ?>

                            </tbody>
                        </table>
                    <?php }  else {  include ("inc_solicita_soporte.php"); } ?>
            </div>
        </div>
<!--        Fin listado fotos-->
    </div>
</div>

<script type="text/javascript">
    function validateFileType(){
        var fileName = document.getElementById("fileName").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            //TO DO
        }else{
            alert("Solo archivo jpg/jpeg están permitidos!");
        }
    }
</script>


