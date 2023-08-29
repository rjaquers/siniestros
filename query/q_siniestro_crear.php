<?php

include_once("../c_connections/conec6.php");
include_once("../c_connections/funciones.php");

//Descripción: Crea una nueva clave para el usuario del correo registrado
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
if (($_POST['id_formulario']) and ($_POST['id_formulario'] == 106)) {
    $nro_siniestro = trim(filter_input(INPUT_POST, 'nro_siniestro', FILTER_SANITIZE_STRING));
    $patente = trim(filter_input(INPUT_POST, 'patente', FILTER_SANITIZE_STRING));
    $nombres = trim(filter_input(INPUT_POST, 'nombres', FILTER_SANITIZE_STRING));
    $correo = trim(filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_EMAIL));
    $telefono = trim(filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING));
    $id_aseguradora = trim(filter_input(INPUT_POST, 'id_aseguradora', FILTER_SANITIZE_NUMBER_INT));
    $id_usuario = trim(filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT));
    //Defino destino de la página

    if (isset($conec6)) {
        //primero debo registrar al cliente
       $q_asegurado =  sprintf("INSERT INTO `tbl_asegurado` (  `nombres`, `telefono`, `correo`, `id_aseguradora`,  `id_usuario`)   VALUES ( '%s', '%s', '%s', %d, %d )",
                               $nombres,     $telefono,    $correo,    $id_aseguradora,  $id_usuario);
        $re_asegurado = mysqli_query($conec6, $q_asegurado) or die(mysqli_errno($conec6)."Error X100 : $q_asegurado ");
        $id_asegurado = mysqli_insert_id( $conec6);

        //Segundo registro la patente
        $q_patente = sprintf(" INSERT INTO `tbl_patentes` (  `patente`, `id_asegurado`, `id_usuario`) VALUES ('%s', %d, %d ) ",
                             $patente, $id_asegurado, $id_usuario);
        $re_patente = mysqli_query($conec6, $q_patente) or die(mysqli_errno($conec6)."Error X200 : $q_patente ");
        $id_patente = mysqli_insert_id( $conec6);

        //Registro el siniestro
        $q_siniestro = sprintf( "INSERT INTO `tbl_siniestros` (   `nro_siniestro`, `id_patente`,  `id_usuario`)    VALUES (  '%s', %d, %d   )",
                                  $nro_siniestro, $id_patente,  $id_usuario );
        $re_siniestro = mysqli_query($conec6, $q_siniestro) or die(mysqli_errno($conec6)."Error X300 : $q_siniestro ");
        $id_siniestro = mysqli_insert_id($conec6);

        //mando a llamar la función que registra el historial del siniestro

        fn_reg_estado_siniestro($id_siniestro, 1 , $id_usuario);
    } else { die("No hay conexión de datos"); }

    $destino = "../home_admin.php?";
    $destino .= "id_siniestro=$id_siniestro&";
    $destino .= "id_patente=$id_patente&";
    $destino .= "patente=$patente&";
    $destino .= "accion=Ver&";
    $destino .= "seccion=Administraci&oacute;n de Siniestros&";
    $destino .= "desc_pagina=Administración de Patentes y siniestros&";

    if (isset($_POST['fotos']) and ($_POST['fotos'] == 0)) //No quiero agregar fotos de inmediato
    {
        $destino .= "template=t_fotos_listar&";
        $destino .= "titulo_pagina=Patentes%20%3E%20Ver%20Siniestros";
        header("Location: ".$destino);
    } else {
        //Si quiero agregar fotos de inmediato.
        $destino .= "template=t_fotos_listar&";
        $destino .= "titulo_pagina=Siniestros>Agregar Fotosr&";
        header("Location: ".$destino);
    }




}