<?php
//include_once("../c_connections/conec6.php");
//require_once('../c_connections/funciones.php');
//Descripción: Cambia el estado de la foto de Actino a inacativo
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
//Busco si existe el sinietro, si no puedo mostrar los ultimos sinietros ingresados.

 //busqueda general por nro de sinietro
$q_siniestro =   "SELECT  `S`.`id_siniestro`,
                                        `S`.`nro_siniestro`,
                                        `S`.`id_patente`,
                                        `S`.`id_estado`,
                                        `S`.`fecha_registro`,
                                        `S`.`fecha_actualizacion`,
                                        `S`.`activo`,
                                        `S`.`id_usuario`,
                                        `E`.`id_estado`,
                                         `E`.`nombre`,
                                        `E`.`descripcion`,  `P`.`patente`
                                    FROM
                                        `tbl_siniestros` AS `S`
                                        LEFT JOIN `tbl_estados` AS `E` ON `S`.`id_estado` = `E`.`id_estado` 
                                        LEFT JOIN  `tbl_patentes` AS `P` ON `S`.`id_patente` = `P`.`id_patente`
                                         WHERE `S`.`activo` = 1";
//busqueda especifica  por nro de sinietro
if (isset($_GET['nro_siniestro'])) {
    $nro_siniestro = trim(filter_input(INPUT_GET, 'nro_siniestro', FILTER_SANITIZE_STRING));
    $q_siniestro = sprintf( " %s and `nro_siniestro` = '%s' ",  $q_siniestro, $nro_siniestro);
}
$q_siniestro =  sprintf("%s ORDER BY  `S`.`fecha_registro`   DESC  LIMIT 2000",  $q_siniestro);
$re_siniestro = mysqli_query($conec6, $q_siniestro) or die(mysqli_error($conec6)." - Error 43 $q_siniestro");
$row_siniestro = mysqli_fetch_assoc($re_siniestro);
$totalRows_siniestro = mysqli_num_rows($re_siniestro);
