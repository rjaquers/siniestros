<?php
include_once("../c_connections/conec6.php");
require_once('../c_connections/funciones.php');
//Descripción: Crea una nueva clave para el usuario del correo registrado
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
$url_usuario_NO_valido = "../f_login.php";
if (isset($_POST['id_formulario']) and ($_POST['id_formulario'] == 200)) {
    //a donde lo envío si es correcto el correo
    $correo_usuario = trim(filter_input(INPUT_POST, 'correo_usuario', FILTER_SANITIZE_EMAIL));
    //Preparo la pregunta
    if (isset($conec6)) {
        $q_s_usuario = sprintf("SELECT `id_usuario`, `id_perfil`, `nombres_usuario`, `correo_usuario`, `clave_usuario` FROM `tbl_usuarios` 
                                       WHERE `correo_usuario` = '%s' AND `activo` = 1", $correo_usuario);
        $re_s_usuario = mysqli_query($conec6, $q_s_usuario) or die(mysqli_errno($conec6)."Error X1 : $q_s_usuario ");
        $total_s_usuario = mysqli_num_rows($re_s_usuario);
        $row_s_usuario = mysqli_fetch_assoc($re_s_usuario);
        if ($total_s_usuario > 0) {
            $id_usuario = $row_s_usuario['id_usuario'];
            $correo_usuario = $row_s_usuario['correo_usuario'];
            $nombres_usuario = $row_s_usuario['nombres_usuario'];
            $clave_usuario = $row_s_usuario['clave_usuario'];
            $clave_generada = fn_generaPass();
            $clave_nueva = password_hash($clave_generada, PASSWORD_DEFAULT); //se encripta la clave
            $q_update_clave = sprintf("UPDATE `tbl_usuarios` SET `clave_usuario` = '%s' WHERE  `id_usuario` = %d   ", $clave_nueva, $id_usuario);
            $re_update_clave = mysqli_query($conec6, $q_update_clave) or die(mysqli_errno($conec6)."Error X2 :  $q_update_clave ");
            fn_enviar_mail_recupera_clave($correo_usuario, $clave_generada);

        } else {
            $error = "no se encontró el usuario";
            header("Location: ".$url_usuario_NO_valido."?error=".$error);
        }

    } else {
        $error = "No hay conexión a base de datos";
        header("Location: ".$url_usuario_NO_valido."?error=".$error);
    }
    mysqli_free_result($re_s_usuario);

}
// si no llega por el formulario lo mando de vuelta
    header("Location: ".$url_usuario_NO_valido);
