<?php
require_once("query/q_usuario_x_id.php");
?>
<div class="row" xmlns="http://www.w3.org/1999/html">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Usuarios <span class="fw-300"><i><?php echo $_GET['accion']; ?></i></span>
                </h2>
                <div class="panel-toolbar">
                    <?php include_once("inc_balls.inc"); ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">


                    <form action="query/q_usuario_borrar.php" name="borrar registros" method="post" enctype="multipart/form-data" accept-charset="x-iso-8859-11">
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
                                                             ¿  Está seguro que desea eliminar este registro?
                                                                <h3 class="text-white   text-nowrap">
                                                                   <?php echo $row_usuario_x_id['nombres_usuario']; ?>
                                                                </h3>

                                                                <input type="radio" name="si_eliminar" id="radios-0" value="1">Si, elimínelo

                                                            </span>
                                    <br>
                                    Nota: Esta acción no tiene vuelta atrás.
                                </div>
                            </div>


                            <div class="form-group text-center">
                                <div class="btn-group">
                                    <button type="button" name="cancel" value="0" class="btn btn-warning legitRipple " onclick="history.go(-1)">
                                        <i class="fas fa-long-arrow-alt-left position-left"></i> No estoy seguro, volver atrás.
                                    </button>

                                    <button type="submit" name="submit-btn" value="1" class="btn btn-danger legitRipple"> Si, Eliminar
                                        <i class="fas fa-check position-right"></i></button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_formulario" value="103">
                        <input type="hidden" name="id_usuario" value="<?php echo $row_usuario_x_id['id_usuario']; ?>">
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>