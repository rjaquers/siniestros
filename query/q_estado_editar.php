<?php
include_once("../c_connections/conec6.php");
//require_once('../c_connections/funciones.php');
//Descripción: Crea una nueva clave para el usuario del correo registrado
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
$destino =  "../home_admin.php?";
$destino.=  "template=t_estado_listar&";
$destino.=  "accion=listar&";
$destino.=  "titulo_pagina=Administración>Estados&";
$destino.=  "seccion=Administraci&oacute;n&";
$destino.=  "desc_pagina=Administración de estados";
if (isset($_POST['id_formulario']) and ($_POST['id_formulario'] == 110)) {
    //a donde lo envío si es correcto el correo
    $id_estado = trim(filter_input(INPUT_POST, 'id_estado', FILTER_SANITIZE_NUMBER_INT));
    $nombre = trim(filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING));
    $descripcion = trim(filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING));
    $activo = trim(filter_input(INPUT_POST, 'activo', FILTER_SANITIZE_NUMBER_INT));


    //Preparo la pregunta
    if (isset($conec6)) {

        $q_u_estado = sprintf(
            "UPDATE `tbl_estados` SET `nombre` = '%s', `descripcion` = '%s', `activo` = %d  WHERE `tbl_estados`.`id_estado` = %d   ",
        $nombre,
            $descripcion,
            $activo,
        $id_estado );
        $re_u_estado = mysqli_query($conec6, $q_u_estado) or die(mysqli_errno($conec6)."Error X100 : $q_u_estado ");
        mysqli_free_result($re_u_estado);
        header("Location: ".$destino);
    } else {
        $error = "No hay conexión a base de datos";
        header("Location: ".$destino."?error=".$error);
    }
}


