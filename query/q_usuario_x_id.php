<?php
//Descripción: Crea la sesión de un usuario.
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
if (isset($_GET['id_usuario'])) {
    $id_usuario = trim(filter_input(INPUT_GET, 'id_usuario', FILTER_SANITIZE_STRING));
    if (isset($conec6)) {
        $q_usuario_x_id = sprintf("SELECT `id_usuario`, `id_perfil`, `nombres_usuario`, `correo_usuario`, `clave_usuario`, `fecha_registro`, `fecha_actualizacion`, `activo` FROM `tbl_usuarios` WHERE `id_usuario` = %d", $id_usuario);
        $re_usuario_x_id = mysqli_query($conec6, $q_usuario_x_id) or die(mysqli_error($conec6)." - Error 100 $q_usuario_x_id");
        $row_usuario_x_id = mysqli_fetch_assoc($re_usuario_x_id);
        $totalRows_usuario_x_id = mysqli_num_rows($re_usuario_x_id);
    }
}