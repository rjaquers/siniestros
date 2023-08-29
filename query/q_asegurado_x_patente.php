<?php
//Descripción: Va a buscar los datos del cliente
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
if (isset($_GET['id_patente'])) {
    $id_patente = trim(filter_input(INPUT_GET, 'id_patente', FILTER_SANITIZE_STRING));
    if (isset($conec6)) {
        $q_asegurado = sprintf("SELECT `id_asegurado` FROM `tbl_patentes` WHERE `id_patente` = %d", $id_patente);
        $re_id_asegurado_x_patente = mysqli_query($conec6, $q_id_asegurado_x_patente) or die(mysqli_error($conec6)." - Error 100 $q_id_asegurado_x_patente");
        $row_id_asegurado_x_patente = mysqli_fetch_assoc($re_id_asegurado_x_patente);
        $totalRows_id_asegurado_x_patente = mysqli_num_rows($re_id_asegurado_x_patente);
        
        if($row_id_asegurado_x_patente['id_asegurado'] == '')
        {


        } else
        {

        }
    }
}

