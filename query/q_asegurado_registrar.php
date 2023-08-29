<?php
//Descripción: Crea la sesión de un usuario.
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
include('../c_connections/conec6.php');
if (isset($conec6)) {
    $nombres = trim(filter_input(INPUT_POST, 'nombres', FILTER_SANITIZE_STRING));
    $telefono = trim(filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING));
    $correo = trim(filter_input(INPUT_POST, 'correo', FILTER_SANITIZE_STRING));
    $id_aseguradora = trim(filter_input(INPUT_POST, 'id_aseguradora', FILTER_SANITIZE_NUMBER_INT));
    $id_asegurado = trim(filter_input(INPUT_POST, 'id_asegurado', FILTER_SANITIZE_NUMBER_INT));
    $id_patente = trim(filter_input(INPUT_POST, 'id_patente', FILTER_SANITIZE_NUMBER_INT));
    if (isset($_POST['id_asegurado']) and $_POST['id_asegurado'] > 0) {
        //entonces el asegurado existe y solo hay que editarlo.
        // debo saber el id para actualizarlo
        $q_sql = sprintf( " UPDATE `tbl_asegurado` SET `nombres` = '%s', `telefono` = '%s', `correo` = '%s', `id_aseguradora` = %d 
                                        WHERE `tbl_asegurado`.`id_asegurado` = %d limit 1  ",
            $nombres,
                    $telefono,
                    $correo,
                    $id_aseguradora,
                    $id_asegurado);
        $re_sql = mysqli_query($conec6, $q_sql) or die(mysqli_error($conec6)." - Error 100 $q_sql");
    } else {
        //el asegurado no existe y hay que registrarlo
        $q_sql = sprintf(" INSERT INTO `tbl_asegurado` ( `nombres`, `telefono`, `correo`, `id_aseguradora` ) VALUES
                                   (  '%s', '%s', '%s', %d )",  $nombres, $telefono, $correo , $id_aseguradora );
        $re_sql = mysqli_query($conec6, $q_sql) or die(mysqli_error($conec6)." - Error 200 $q_sql");
        $id_asegurado = mysqli_insert_id($conec6);
        // pero además debo asociar este ID al Nro de patente.
        $q_sql2 = sprintf("UPDATE `tbl_patentes` SET `id_asegurado` = %d WHERE `tbl_patentes`.`id_patente` = %d",  $id_asegurado, $id_patente  );
        $re_sql2 = mysqli_query($conec6, $q_sql2) or die(mysqli_error($conec6)." - Error 300 $q_sql2");
    }

    $volver = $_SERVER['HTTP_REFERER'] ;
    if (isset($_SERVER['QUERY_STRING'])) {
        $volver .= (strpos($volver, '?')) ? "&" : "?";
        $volver .= $_SERVER['QUERY_STRING'];
        $volver .= "&volver=1";
        header(sprintf("Location: %s", $volver));
    }



} else { print "No hay conexón a la base de datos";}




