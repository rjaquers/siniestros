<?php

if (isset($_GET["RJE"]) and $_GET["RJE"] == 100) {
require('conec6.php');
include_once("funciones.php");
//    Delcaro  y limpio variables
$q_sql = '';
$patente = trim(filter_input(INPUT_GET, 'patente', FILTER_SANITIZE_STRING));
$q_sql = sprintf("SELECT COUNT(`id_patente`) as total FROM `tbl_patentes` WHERE `patente`  = '%s'  ", $patente );
$re_sql = mysqli_query($conec6, $q_sql) or die(mysqli_error($conec6) . "Error 100-1  $q_sql");
$row_sql = mysqli_fetch_assoc($re_sql);

    if($row_sql['total'] == 0) {
        echo 0 ;
    } else
    {
        echo 1;

    }
mysqli_free_result($re_sql);
}


// Cambia el estado de una función
if (isset($_GET["RJE"]) and $_GET["RJE"] == 02) {
    //preparo consult
    require_once('funciones.php');
    require_once('conec6.php');
    //nuevo Registro
    $insertSQL = '';

    // Limpio variables
    if (isset($_GET['id_estado'])) {  $id_estado = trim(filter_input(INPUT_GET, 'id_estado', FILTER_SANITIZE_NUMBER_INT)); } else {  return "error 201";}
    if (isset($_GET['id_siniestro'])) {  $id_siniestro = trim(filter_input(INPUT_GET, 'id_siniestro', FILTER_SANITIZE_NUMBER_INT)); } else {  return "error 101";}
    if (isset($_GET['id_usuario'])) {  $id_usuario = trim(filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_NUMBER_INT)); } else {  return "error 301";}

    $q_sql = sprintf("UPDATE `tbl_siniestros` SET `id_estado` = %d WHERE  `id_siniestro` = %d",$id_estado, $id_siniestro );
     mysqli_query($conec6, $q_sql) or die(mysqli_error($conec6) . "Error 100-1  $q_sql");

    //aquí debo colocar la funcion que registra todos los movimientos.  en tabla tbl_estados_historial funciones.php

    //fn_toLog( $q_sql, $id_usuario );
    echo($q_sql);
     fn_reg_estado_siniestro($id_siniestro, $id_estado, $id_usuario);
    // Registro de LOg
}
