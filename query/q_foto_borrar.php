<?php

include_once("../c_connections/conec6.php");
//require_once('../c_connections/funciones.php');
//Descripción: Cambia el estado de la foto de Actino a inacativo
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
if (isset($_POST['id_formulario']) and ($_POST['id_formulario'] == 108) and ($_POST['si_eliminar'] == 1)) {
    $id_foto = trim(filter_input(INPUT_POST, 'id_foto', FILTER_SANITIZE_NUMBER_INT));
    $id_patente = trim(filter_input(INPUT_POST, 'id_patente', FILTER_SANITIZE_NUMBER_INT));
    $patente = trim(filter_input(INPUT_POST, 'patente', FILTER_SANITIZE_NUMBER_INT));
    $accion = trim(filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_NUMBER_INT));
    $activo = trim(filter_input(INPUT_POST, 'si_eliminar', FILTER_SANITIZE_NUMBER_INT));
    $id_siniestro = trim(filter_input(INPUT_POST, 'id_siniestro', FILTER_SANITIZE_NUMBER_INT));

    $destino = "../".$_SESSION['home']."?";
    $destino .= "id_siniestro=".$id_siniestro."&";
    $destino .= "id_patente=".$id_patente."&";
    $destino .= "patente=".$patente."&";
    $destino .= "accion=listar Fotos&";
    $destino .= "template=t_fotos_listar&";
    $destino .= "titulo_pagina=Patentes>Ver_Fotos&";
    $destino .= "seccion=Administraci&oacute;n&";
    $destino .= "desc_pagina=Ver Fotos Siniestros";




    //a donde lo envío si es correcto el correo

    $q_sql = sprintf("UPDATE `tbl_fotos` SET  `activo`= 0 WHERE `id_foto`=  %d", $id_foto);
    $re_sql = mysqli_query($conec6, $q_sql) or die(mysqli_error($conec6)." - Error 100 $q_sql");

    header("Location: ".$destino);
} else {
    die("No eliminado");
}