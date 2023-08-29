<?php

include_once("../c_connections/conec6.php");
//require_once('../c_connections/funciones.php');
//Descripción: Crea una nueva clave para el usuario del correo registrado
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
$destino = "../$_SESSION['home'].php?";
$destino .= "template=t_usuarios_listar&";
$destino .= "accion=listar&";
$destino .= "titulo_pagina=Administración>Usuarios&";
$destino .= "seccion=Administraci&oacute;n&";
$destino .= "desc_pagina=Administración de usuarios";

if (isset($_POST['id_formulario']) and ($_POST['id_formulario'] == 103) and ($_POST['si_eliminar'] == 1)) {
    //a donde lo envío si es correcto el correo
    $id_usuario = trim(filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT));
    $activo = trim(filter_input(INPUT_POST, 'si_eliminar', FILTER_SANITIZE_NUMBER_INT));
    $q_sql = sprintf("UPDATE `tbl_usuarios` SET  `activo`= 0 WHERE `id_usuario`=  %d", $id_usuario);
    $re_sql = mysqli_query($conec6, $q_sql) or die(mysqli_error($conec6)." - Error 100 $q_sql");

    header("Location: ".$destino);
} else {
    die("No eliminado");
}