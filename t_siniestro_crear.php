<?php include_once("c_connections/conec6.php");
include_once("query/q_aseguradoras.php");
//if (isset($_GET['patente'])) {
//    $patente = trim(filter_input(INPUT_GET, 'patente', FILTER_SANITIZE_STRING));
//    $id_patente = trim(filter_input(INPUT_GET, 'id_patente', FILTER_SANITIZE_STRING));
//}
//?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2> Siniestros Formulario <span class="fw-300"><i><?php echo $_GET['accion']; ?> </i></span></h2>

                <div class="panel-toolbar  ">   <?php include_once("inc_balls.inc"); ?>   </div>

            </div>
            <div class="panel-container show">
                <div class="panel-content">

                    <form action="query/q_siniestro_crear.php" class="form-horizontal" method="post" name="siniestros" accept-charset="x-iso-8859-11" enctype="multipart/form-data">
                        <fieldset>

                            <!-- Text input-->
                            <div class="form-group">

                                <div class="col-md-4">
                                    <input id="nro_siniestro" name="nro_siniestro" type="text" placeholder="Nro. Siniestro" class="form-control input-md">
                                </div>

                                <div class="col-md-4">
                                    <input id="patente" name="patente" type="text" placeholder="patente" class="form-control input-md">
                                </div>

                                <div class="col-md-4">
                                    <input required name="nombres" type="text" placeholder="nombres " class="form-control input-md" value="">
                                </div>


                                <div class="col-md-4">
                                    <input required name="correo" type="text" placeholder="correo" class="form-control input-md" value="">
                                </div>


                                <div class="col-md-4">
                                    <input required name="telefono" type="text" placeholder="telefono" class="form-control input-md" value="">
                                </div>

                                <div class="col-md-4">

                                    <select class="col-md-4 form-control input-md" name="id_aseguradora">
                                        <option disabled selected>Seleccionar</option>
                                        <?php do { ?>
                                            <option value="<?php echo $row_sAseguradora['id_aseguradora']; ?>" <?php if (isset($row_asegurado_x_id['id_aseguradora']) and ($row_asegurado_x_id['id_aseguradora'] == $row_sAseguradora['id_aseguradora'])) {
                                                echo "selected";
                                            }; ?> ><?php echo $row_sAseguradora['nombre_aseguradora']; ?></option>
                                        <?php } while ($row_sAseguradora = mysqli_fetch_assoc($re_sAseguradora)); ?>
                                    </select>
                                </div>


                            </div>

                        <!-- Multiple Radios -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="radios">¿Registrar Fotos inmediatamente?</label>
                            <div class="col-md-4">
                                <div class="radio">
                                    <label for="radios-0">
                                        <input type="radio" name="fotos" id="radios-0" value="1">
                                        Si
                                    </label>
                                </div>
                                <div class="radio">
                                    <label for="radios-1">
                                        <input type="radio" name="fotos" id="radios-1" value="0" checked="checked">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Button (Double) -->
                        <div class="form-group">

                            <div class="col-md-8">
                                <button id="button1id" name="button1id" class="btn btn-success">Volver</button>
                                <button id="button2id" name="button2id" class="btn btn-danger">Grabar</button>
                            </div>
                        </div>

                        </fieldset>
                        <input type="hidden" name="id_formulario" value="106">
                        <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario'] ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
