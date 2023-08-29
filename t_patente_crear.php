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


                    <form action="query/q_patente_crear.php" name="form56" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <!-- Form Name -->
                            <legend>Patente > Crear</legend>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="Correo_usuario:">Patente: (Formato: XXXX-XX)</label>
                                <div class="col-md-4">
                                    <input id="patente" name="patente" type="text" maxlength="7" placeholder="CZPF-90" pattern="[A-Za-z]{4}[-]{1}[0-9]{2}" class="form-control input-md" >
                                    <input type="submit" id="btn_patente" class="btn btn-primary" value="Registrar"  onmouseover="fnjs_existe_patente(patente.value)" >
                                    <div id="patente_ok"></div>
                                </div>
                            </div>
                        </fieldset>
                        <input type="hidden" name="id_formulario" value="109">
                        <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['id_usuario']; ?>">
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>


