<?php
//Consulta base de datos por todas las fotos asociadas a un id Siniestro que esten activas
if (isset($_GET['id_siniestro'])) {
    ini_set('max_execution_time', '600');
   if (isset($_GET['$id_siniestro'])) {
           $id_siniestro = trim(filter_input(INPUT_GET, '$id_siniestro', FILTER_SANITIZE_STRING));
       }

     include_once('c_connections/conec6.php');
    //require_once('../c_connections/funciones.php');

    $id_siniestro = trim(filter_input(INPUT_GET, 'id_siniestro', FILTER_SANITIZE_NUMBER_INT));
    $carpeta_siniestro = $id_siniestro;

    $q_fotos_carr = sprintf("SELECT * FROM `tbl_fotos` WHERE `activo` = 1 AND  `id_siniestro` = %d ORDER BY `fecha_registro` ASC", $id_siniestro);
    $re_fotos_carr = mysqli_query($conec6, $q_fotos_carr) or die(mysqli_error($conec6)." - Error 100 $q_fotos_carr");
    $row_fotos_carr = mysqli_fetch_assoc($re_fotos_carr);
    $totalRows_fotos_carr = mysqli_num_rows($re_fotos_carr);

    //echo $q_fotos_carr;
}