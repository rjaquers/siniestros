<?php
//Descripción: Crea la sesión de un usuario.
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
if (isset($_GET['id_patente'])) {
    $id_patente = trim(filter_input(INPUT_GET, 'id_patente', FILTER_SANITIZE_STRING));
    if (isset($conec6)) {
        $q_patente_x_id = sprintf("SELECT * FROM `tbl_patentes` WHERE `id_patente` = %d", $id_patente);
        $re_patente_x_id = mysqli_query($conec6, $q_patente_x_id) or die(mysqli_error($conec6)." - Error 100 $q_patente_x_id");
        $row_patente_x_id = mysqli_fetch_assoc($re_patente_x_id);
        $totalRows_patente_x_id = mysqli_num_rows($re_patente_x_id);
    }
}

