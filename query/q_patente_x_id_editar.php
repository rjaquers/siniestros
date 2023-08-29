<?php
include_once "../c_connections/conec6.php";
//Descripción: Crea la sesión de un usuario.
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
if (isset($_POST['id_formulario']) and ( $_POST['id_formulario']== 105) ) {
    $destino = "../home_admin.php?";
    $destino .= "template=t_patentes_listar&";
    $destino .= "accion=listar&";
    $destino .= "titulo_pagina=Patentes>Listar&";
    $destino .= "seccion=Administraci&oacute;n&";
    $destino .= "desc_pagina=Administración de patente";
    $id_patente = trim(filter_input(INPUT_POST, 'id_patente', FILTER_SANITIZE_NUMBER_INT));
    $patente = trim(filter_input(INPUT_POST, 'patente', FILTER_SANITIZE_STRING));
    $id_usuario = trim(filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT));
    if (isset($conec6)) {
        $q_u_patente = sprintf("Update `tbl_patentes`  SET  `patente` = '%s', `id_usuario` = %d  WHERE `id_patente` = %d",
                                  $patente,
                                        $id_usuario,
                                        $id_patente );

        $re_u_patente = mysqli_query($conec6, $q_u_patente) or die(mysqli_error($conec6)." - Error 100 $q_u_patente");
    }
    header("Location: ".$destino);
}

