<?php
include_once("../c_connections/conec6.php");
//require_once('../c_connections/funciones.php');
//Descripción: Crea una nueva clave para el usuario del correo registrado
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
$destino = "../home_admin.php?";
$destino .= "template=t_patentes_listar&";
$destino .= "accion=listar&";
$destino .= "titulo_pagina=Patentes>Listar&";
$destino .= "seccion=Administraci&oacute;n&";
$destino .= "desc_pagina=Administración de patente";

if (isset($_POST['id_formulario']) and ($_POST['id_formulario'] == 104) and ($_POST['si_eliminar'] == 1)) {
    //a donde lo envío si es correcto el correo
    $id_patente = trim(filter_input(INPUT_POST, 'id_patente', FILTER_SANITIZE_NUMBER_INT));
    $activo = trim(filter_input(INPUT_POST, 'si_eliminar', FILTER_SANITIZE_NUMBER_INT));
    $q_sql = sprintf("UPDATE `tbl_patentes` SET  `activo`= 0 WHERE `id_patente`=  %d", $id_patente);
    $re_sql = mysqli_query($conec6, $q_sql) or die(mysqli_error($conec6)." - Error 100 $q_sql");

    header("Location: ".$destino);
} else {
    die("No eliminado");
}