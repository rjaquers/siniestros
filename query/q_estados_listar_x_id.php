<?php
//include_once("../c_connections/conec6.php");
//require_once('../c_connections/funciones.php');
//Descripción: Cambia el estado de la foto de Actino a inacativo
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
   if (isset($_GET['id_estado'])) {
           $id_estado = trim(filter_input(INPUT_GET, 'id_estado', FILTER_SANITIZE_NUMBER_INT));
       }
$q_estado_x_id = sprintf("select * from `tbl_estados`  WHERE `id_estado` = %d  ORDER BY  `id_estado` ASC limit 200", $id_estado );

 
$re_estado_x_id = mysqli_query($conec6, $q_estado_x_id) or die(mysqli_error($conec6)." - Error 43 $q_estado_x_id");
$row_estado_x_id = mysqli_fetch_assoc($re_estado_x_id);
$totalRows_estado_x_id = mysqli_num_rows($re_estado_x_id);