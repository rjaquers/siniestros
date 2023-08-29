<?php
//include_once("../c_connections/conec6.php");
//require_once('../c_connections/funciones.php');
//Descripción: Cambia el estado de la foto de Actino a inacativo
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
$q_estados = sprintf("select * from `tbl_estados`  ORDER BY  `id_estado` ASC limit 200", 1);
$re_estados = mysqli_query($conec6, $q_estados) or die(mysqli_error($conec6)." - Error 43 $q_estados");
$row_estados = mysqli_fetch_assoc($re_estados);
$totalRows_estados = mysqli_num_rows($re_estados);