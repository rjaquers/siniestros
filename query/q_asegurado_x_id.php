<?php
//Descripción: Crea la sesión de un usuario.
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque

    if (isset($conec6)) {
        $q_asegurado_x_id = sprintf("SELECT `id_asegurado`, `nombres`, `telefono`, `correo`, `id_aseguradora`, `activo` FROM `tbl_asegurado` WHERE `id_asegurado` = %d", $id_asegurado);
        $re_asegurado_x_id = mysqli_query($conec6, $q_asegurado_x_id) or die(mysqli_error($conec6)." - Error 100 $q_asegurado_x_id");
        $row_asegurado_x_id = mysqli_fetch_assoc($re_asegurado_x_id);
        $totalRows_asegurado_x_id = mysqli_num_rows($re_asegurado_x_id);

}

