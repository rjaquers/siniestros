<?php include_once("c_connections/conec6.php");
include("query/q_estados_listar_x_id.php");
?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Estado Editar</span>
                </h2>
                <div class="panel-toolbar">
                    <?php include_once("inc_balls.inc"); ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">


                    <form action="query/q_estado_editar.php" name="form56" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <!-- Form Name -->
                            <legend>Estado > Editar</legend>

                            <!-- Text Nombre-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="nombre:">Nombre:</label>
                                <div class="col-md-4">
                                    <input required name="nombre" type="text" placeholder="placeholder" class="form-control input-md"
                                           value="<?php echo $row_estado_x_id['nombre']; ?>">
                                </div>
                            </div>

                            <!-- Text 3 	descripcion -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="descripcion">Descripción :</label>
                                <div class="col-md-4">
                                    <textarea name="descripcion" class="form-control input-md" rows="10" cols="50"><?php echo $row_estado_x_id['descripcion']; ?></textarea>

                                </div>
                            </div>

                            <!-- Text 3 	activo -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="activo">activo :</label>
                                <div class="col-md-4">


                                    <input type="radio" name="activo" value="1" <?php if (! (strcmp(htmlentities($row_estado_x_id['activo'], ENT_COMPAT, ''), 1))) {
                                        echo "checked=\"checked\"";   } ?>>
                                    Si / <input type="radio" name="activo" value="0" <?php if (! (strcmp(htmlentities($row_estado_x_id['activo'], ENT_COMPAT, ''), 0))) {
                                        echo "checked=\"checked\"";    } ?>> No
                                </div>


                            </div>


                </fieldset>
                <br>
                <input type="submit" class=" btn-primary" value="Grabar">
                <input type="hidden" name="id_formulario" value="110">
                <input type="hidden" name="id_estado" value="<?php echo $row_estado_x_id['id_estado']; ?>">

                </form>
            </div>

        </div>
    </div>
</div>
</div>
