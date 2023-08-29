<?php
//include_once("../c_connections/conec6.php");
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

$q_sAseguradora = "SELECT * FROM `tbl_aseguradora`   WHERE `activo` = 1";
$re_sAseguradora = mysqli_query($conec6, $q_sAseguradora) or die(mysqli_error($conec6)." - Error 43 $q_sAseguradora");
$row_sAseguradora = mysqli_fetch_assoc($re_sAseguradora);
$totalRows_sAseguradora = mysqli_num_rows($re_sAseguradora);