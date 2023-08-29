<div class="row" xmlns="http://www.w3.org/1999/html">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2>
                    Asegurado <span class="fw-300"><i><?php echo $_GET['accion']; ?></i></span>
                </h2>
                <div class="panel-toolbar">
                    <?php include_once("inc_balls.inc"); ?>
                </div>
            </div>
            <div class="panel-container show">
                <div class="panel-content">

                    <?php
                    // si el resultado es 0 (cero) no hay cliente registrado, cualquier otro nro indicará el id del Cliente registrado.
                       if (isset($_GET['id_patente'])) {
                               $id_patente = trim(filter_input(INPUT_GET, 'id_patente', FILTER_SANITIZE_NUMBER_INT));

                          $resultado = fn_cliente_registrado($id_patente);
echo $resultado;

                           if($resultado > 0) {
                               // si el nro es mayor que cero entonces debo ir a buyscar los datos del cliente en consulta SQL con el id
                               // sino muestras los campos de edición
                               $id_asegurado = $resultado;

                               require("query/q_asegurado_x_id.php");
                           }
                           } else
                       {
                           print("<h3>Falta la id de la patente</h3>");
                           die();
                       }

                    ?>

<!--// Si solo hay que editar se colocan los datos del cliente, pero si no hay datos del cliente, se debe registrar los datos y asocial el ID a la base de datos del cliente


 -->
                    <?php if (isset($_GET['volver'])) { ?>
                        <script>
                            alert("Datos grabados");
                        </script>
                        <?php  } ?>
                    <form action="query/q_asegurado_registrar.php" name="form56" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <!-- Form Name -->
                            <legend>  <?php echo $_GET['titulo_pagina']; ?></legend>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label"  ">Nombres :</label>
                                <div class="col-md-4">
                                    <input required name="nombres" type="text" placeholder="nombres " class="form-control input-md"
                                           value="<?php if($resultado > 0) { echo $row_asegurado_x_id['nombres'];} ?>">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"  ">nombres :</label>
                                <div class="col-md-4">
                                    <input required name="telefono" type="text" placeholder="telefono" class="form-control input-md"
                                           value="<?php if($resultado > 0) { echo $row_asegurado_x_id['telefono'];} ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label"  ">correo :</label>
                                <div class="col-md-4">
                                    <input required name="correo" type="text" placeholder="correo" class="form-control input-md"
                                           value="<?php if($resultado > 0) { echo $row_asegurado_x_id['correo'];} ?>">
                                </div>
                            </div>



                            <div class="form-group">
                                <label class="col-md-4 control-label">Aseguradora :</label>
                                <div class="col-md-4">

                                </div>
<!--                                select aseguradora-->
                                  <?php
                                  $q_sAseguradora =  "SELECT * FROM `tbl_aseguradora`   WHERE `activo` = 1"  ;
                                  $re_sAseguradora = mysqli_query($conec6, $q_sAseguradora) or die(mysqli_error($conec6) . " - Error 43 $q_sAseguradora");
                                  $row_sAseguradora = mysqli_fetch_assoc($re_sAseguradora);
                                  $totalRows_sAseguradora = mysqli_num_rows($re_sAseguradora); ?>
                                  <select class="col-md-4"  name="id_aseguradora"  >
                                  <option disabled selected>Seleccionar</option>
                                   <?php     do { ?>
                                  <option value="<?php echo $row_sAseguradora['id_aseguradora']; ?>" <?php if(isset($row_asegurado_x_id['id_aseguradora']) and ($row_asegurado_x_id['id_aseguradora'] == $row_sAseguradora['id_aseguradora'])) { echo "selected"; }; ?> ><?php echo $row_sAseguradora['nombre_aseguradora']; ?></option>
                                  <?php } while ($row_sAseguradora = mysqli_fetch_assoc($re_sAseguradora)); ?>
                                  </select>
                            </div>

                        </fieldset>
                        <br>
                        <input type="submit" class=" btn-primary" value="Registrar">

                        <input type="hidden" name="id_formulario" value="111">
                        <input type="hidden" name="id_asegurado" value="<?php if($resultado > 0) {  echo $row_asegurado_x_id['id_asegurado'];} else { echo 0;} ?>">
                        <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
                        <input type="hidden" name="id_patente" value="<?php echo $_GET['id_patente']; ?>">
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


