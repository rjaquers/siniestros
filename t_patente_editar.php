<?php
 include_once("query/q_patente_x_id.php");
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


                    <form action="query/q_patente_x_id_editar.php" name="form56" method="post" enctype="multipart/form-data"   >
                        <fieldset>
                            <!-- Form Name -->
                            <legend>Patente > Editar</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Correo_patente_x_id:">Patente:</label>
                                <div class="col-md-4">
                                    <input   required name="patente" type="text" placeholder="placeholder" class="form-control input-md"
                                           value="<?php echo $row_patente_x_id['patente']; ?>">
                                </div>
                            </div>


                        </fieldset>


<br>

                    <input type="submit" class=" btn-primary" value="Registrar">

                <input type="hidden" name="id_formulario" value="105">
                <input type="hidden" name="id_patente" value="<?php echo $row_patente_x_id['id_patente']; ?>">
                <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
                </form>
                </div>

            </div>
        </div>
    </div>
</div>
