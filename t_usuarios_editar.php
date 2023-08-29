<?php

if (isset($_GET['id_usuario'])) {
    $id_usuario = trim(filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_STRING));
}
if (isset($conec6)) {
    $q_usuario = sprintf("SELECT * FROM `tbl_usuarios` WHERE `id_usuario` = %d", $id_usuario);
    $re_usuario = mysqli_query($conec6, $q_usuario) or die(mysqli_error($conec6)." - Error 100 $q_usuario");
    $row_usuario = mysqli_fetch_assoc($re_usuario);
    $totalRows_usuario = mysqli_num_rows($re_usuario);

    $q_perfil = sprintf("SELECT `id_perfil`, `nombre_perfil`  FROM `tbl_perfil` WHERE  `activo` = 1", $id_usuario);
    $re_perfil = mysqli_query($conec6, $q_perfil) or die(mysqli_error($conec6)." - Error 100 $q_perfil");
    $row_perfil = mysqli_fetch_assoc($re_perfil);
    $totalRows_perfil = mysqli_num_rows($re_perfil);
}
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


                    <form action="query/q_usuario_editar.php" name="form56" method="post" enctype="multipart/form-data" onsubmit="fnjs_valida_password(); return false">


                        <fieldset>

                            <!-- Form Name -->
                            <legend>Usuarios > Editar</legend>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Correo_usuario:">Correo/usuario:</label>
                                <div class="col-md-4">
                                    <input id="correo_usuario" required name="correo_usuario" type="text" placeholder="placeholder" class="form-control input-md"
                                           value="<?php echo $row_usuario['correo_usuario']; ?>">
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Nombres:</label>
                                <div class="col-md-4">
                                    <input id="nombre_usuario" required name="nombre_usuario" type="text" placeholder="placeholder" class="form-control input-md"
                                           value="<?php echo $row_usuario['nombres_usuario']; ?>">

                                </div>
                            </div>


                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Perfil:</label>
                                <div class="col-md-4">
                                    <select name='id_perfil' class="form-control input-md" required>
                                        <option value='0'>Seleccionar</option>
                                        <option value='<?php echo $row_usuario['id_perfil']; ?>' selected><?php echo fn_nombre_perfil($row_usuario['id_perfil']); ?></option>
                                        <option>------</option>
                                        <?php do { ?>
                                            <option value="<?php echo $row_perfil['id_perfil']; ?>"><?php echo $row_perfil['nombre_perfil']; ?></option>
                                        <?php } while ($row_perfil = mysqli_fetch_assoc($re_perfil)); ?>
                                    </select>
                                </div>
                            </div>


                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Clave:</label>
                                <div class="col-md-4">
                                    <input name="pass1" required min="6" max="10" id="pass1" type="password" placeholder="Clave" class="form-control input-md"
                                           value="<?php echo $row_usuario['clave_usuario']; ?>">

                                </div>
                            </div>


                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textinput">Repita la Clave:</label>
                                <div class="col-md-4">
                                    <input name="pass2" required min="6" max="10" id="pass2" type="password" placeholder="Vuelva a escribir la contraseña" class="form-control input-md">

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-4 control-label" for="radios">Activo</label>
                                <div class="col-md-4">
                                    <div class="radio">
                                        <label for="radios-0">
                                            <input type="radio" name="activo" id="radios-0" value="1" <?php if (! (strcmp(
                                                htmlentities($row_usuario['activo'], ENT_COMPAT, ''),
                                                "1"
                                            ))) {
                                                echo "checked=\"checked\"";
                                            } ?>>
                                            Si
                                        </label>
                                        <label for="radios-1">
                                            <input type="radio" name="activo" id="radios-1" value="0" <?php if (! (strcmp(
                                                htmlentities($row_usuario['activo'], ENT_COMPAT, ''),
                                                "0"
                                            ))) {
                                                echo "checked=\"checked\"";
                                            } ?>>
                                            No
                                        </label>
                                    </div>

                                </div>
                            </div>

                            <label for="ss" class="control-label  w-25" id="tercero" name="tercero"> </label>
                        </fieldset>



                <div class="modal-footer">

                    <input type="submit" class=" btn-primary" value="Registrar">
                </div>
                <input type="hidden" name="id_formulario" value="102">
                <input type="hidden" name="id_usuario" value="<?php echo $row_usuario['id_usuario']; ?>">
                </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function () {
        //variables
        var pass1 = $("[name=pass1]");
        var pass2 = $("[name=pass2]");
        var pass3 = $("[name=tercero]");
        var confirmacion = "Las contraseñas si coinciden";
        var longitud =
            "La contraseña debe estar formada entre 6-10 carácteres (ambos inclusive)";
        var negacion = "No coinciden las contraseñas";
        var vacio = "La contraseña no puede estar vacía";
        //oculto por defecto el elemento span
        var span = $(" <div class='text-info'> </div><br>").insertAfter(pass3);
        span.hide();

        //función que comprueba las dos contraseñas
        function coincidePassword() {
            var valor1 = pass1.val();
            var valor2 = pass2.val();
            //muestro el span
            span.show().removeClass();
            //condiciones dentro de la función
            if (valor1 != valor2) {
                span.text(negacion).addClass("negacion");
            }
            if (valor1.length == 0 || valor1 == "") {
                span.text(vacio).addClass("negacion");
            }
            if (valor1.length < 6 || valor1.length > 10) {
                span.text(longitud).addClass("negacion");
            }
            if (valor1.length != 0 && valor1 == valor2) {
                span.text(confirmacion).removeClass("negacion").addClass("confirmacion");
            }
        }

        //ejecuto la función al soltar la tecla
        pass2.keyup(function () {
            coincidePassword();
        });
    });


</script>
