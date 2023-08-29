<?php
if (isset($_GET['id_foto'])) {
    $id_foto = trim(filter_input(INPUT_GET, 'id_foto', FILTER_SANITIZE_NUMBER_INT));
    $id_siniestro = trim(filter_input(INPUT_GET, 'id_siniestro', FILTER_SANITIZE_NUMBER_INT));
    $nro_siniestro = fn_nro_siniestro($id_siniestro);
    $id_patente = trim(filter_input(INPUT_GET, 'id_patente', FILTER_SANITIZE_NUMBER_INT));
    $patente = trim(filter_input(INPUT_GET, 'patente', FILTER_SANITIZE_STRING));

 
     $q_fotos_x_id = sprintf("SELECT * FROM `tbl_fotos` WHERE `id_foto` = %d ",$id_foto);
     $re_fotos_x_id = mysqli_query($conec6, $q_fotos_x_id) or die(mysqli_error($conec6) . " - Error 43 $q_fotos_x_id");
     $row_fotos_x_id = mysqli_fetch_assoc($re_fotos_x_id);
     $totalRows_fotos_x_id = mysqli_num_rows($re_fotos_x_id);

       

}
?>
<div class="row" xmlns="http://www.w3.org/1999/html">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Patente <span class="fw-300"><i><?php echo $_GET['accion']; ?></i></span>
                </h2>
                <div class="panel-toolbar">
                    <?php include_once("inc_balls.inc"); ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">


                    <form action="query/q_foto_borrar.php" name="borrar registros" method="post" enctype="multipart/form-data" accept-charset="x-iso-8859-11">
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                            </button>
                            <div class="d-flex align-items-center">
                                <div class="alert-icon width-8">
                                                             <span class="icon-stack icon-stack-xl">
                                                               <div class='icon-stack'>
                                                                <i class="base base-7 icon-stack-3x opacity-100 color-danger-700"></i>
                                                                   <i class="base base-7 icon-stack-2x opacity-100 color-warning-100"></i>
                                                                   <i class="fal fa-exclamation-triangle icon-stack-1x opacity-100 color-danger-700"></i>
                            </div>
                                                            </span>
                                </div>
                                <div class="flex-1 pl-1">
                                                            <span class="h2">
                                                            &#191;  Est&aacute;  seguro que desea eliminar esta foto Nro  <?php echo  $row_fotos_x_id['id_foto']; ?>?
                                                                <h3 class="text-white   text-nowrap">

                                                                </h3>
                                                                <img src="img/fotos/<?php echo $row_fotos_x_id['id_patente'];?>/<?php echo $row_fotos_x_id['id_siniestro'];?>/chicas/<?php echo $row_fotos_x_id['url_foto'];?>">
<br>
                                                                <input type="radio" name="si_eliminar" id="radios-0" value="1">Si, elim&iacute;nela

                                                            </span>
                                    <br>
                                    Nota: Esta acci&oacute;n no tiene vuelta atr&aacute;s.
                                </div>
                            </div>


                            <div class="form-group text-center">
                                <div class="btn-group">
                                    <button type="button" name="cancel" value="0" class="btn btn-warning legitRipple " onclick="history.go(-1)">
                                        <i class="fas fa-long-arrow-alt-left position-left"></i> No estoy seguro, volver atr&aacute;s.
                                    </button>

                                    <button type="submit" name="submit-btn" value="1" class="btn btn-danger legitRipple"> Si, Eliminar
                                        <i class="fas fa-check position-right"></i></button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_formulario" value="108">
                        <input type="hidden" name="id_patente" value="<?php echo $row_fotos_x_id['id_patente'];?>">
                        <input type="hidden" name="id_foto" value="<?php echo $row_fotos_x_id['id_foto'];?>">
                        <input type="hidden" name="id_siniestro" value="<?php echo $row_fotos_x_id['id_siniestro'];?>">
                        <input type="hidden" name="accion" value="ver">
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>