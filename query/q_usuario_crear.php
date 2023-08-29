<?php
include_once("../c_connections/conec6.php");
 require_once('../c_connections/funciones.php');
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
    $id_usuario = trim(filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT));

    //Preparo la pregunta
    if (isset($conec6)) {
        $clave_usuario2 = password_hash($clave_usuario, PASSWORD_DEFAULT) ;
        $q_i_usuario = sprintf( "INSERT INTO `tbl_usuarios` ( `id_perfil`, `nombres_usuario`, `correo_usuario`, `clave_usuario` ) 
                    VALUES (  %d, '%s', '%s', '%s'   )", $id_perfil, $nombre_usuario, $correo_usuario,  $clave_usuario2 );
        $re_i_usuario = mysqli_query($conec6, $q_i_usuario) or die(mysqli_errno($conec6)."Error X100 : $q_i_usuario ");

        fn_mail_nuevo_usuario($correo_usuario, $clave_usuario);

        header("Location: ".$destino);
    } else {
        $error = "No hay conexión a base de datos";
        header("Location: ".$destino."?error=".$error);
    }
}