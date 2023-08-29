<?php
include_once("../c_connections/conec6.php");
//require_once('../c_connections/funciones.php');
//Descripción: Crea una nueva clave para el usuario del correo registrado
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
$destino =  "../home_admin.php?";
$destino.=  "template=t_usuarios_listar&";
$destino.=  "accion=listar&";
$destino.=  "titulo_pagina=Administración>Usuarios&";
$destino.=  "seccion=Administraci&oacute;n&";
$destino.=  "desc_pagina=Administración de usuarios";
if (isset($_POST['id_formulario']) and ($_POST['id_formulario'] == 102)) {
    //a donde lo envío si es correcto el correo
    $correo_usuario = trim(filter_input(INPUT_POST, 'correo_usuario', FILTER_SANITIZE_EMAIL));
    $nombre_usuario = trim(filter_input(INPUT_POST, 'nombre_usuario', FILTER_SANITIZE_STRING));
    $id_perfil = trim(filter_input(INPUT_POST, 'id_perfil', FILTER_SANITIZE_NUMBER_INT));
    $clave_usuario = trim(filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_STRING));
    $activo = trim(filter_input(INPUT_POST, 'activo', FILTER_SANITIZE_NUMBER_INT));
    $id_usuario = trim(filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT));

    //Preparo la pregunta
    if (isset($conec6)) {
        $clave_usuario = password_hash($clave_usuario, PASSWORD_DEFAULT) ;
        $q_u_usuario = sprintf(
            "UPDATE `tbl_usuarios` SET `correo_usuario` = '%s', `nombres_usuario` = '%s', `id_perfil` = %d,    `clave_usuario` = '%s'  , 
               `activo` = %d        WHERE   `id_usuario` = %d   ",
            $correo_usuario, $nombre_usuario, $id_perfil, $clave_usuario, $activo,  $id_usuario );
        $re_u_usuario = mysqli_query($conec6, $q_u_usuario) or die(mysqli_errno($conec6)."Error X100 : $q_u_usuario ");
        mysqli_free_result($re_u_usuario);
        header("Location: ".$destino);
    } else {
        $error = "No hay conexión a base de datos";
        header("Location: ".$destino."?error=".$error);
    }
}


