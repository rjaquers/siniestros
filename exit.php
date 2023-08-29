<?php
// *** Logout the current user.
$destino = "f_login.php";
if (!isset($_SESSION)) {
    session_start();
}

$_SESSION['id_usuario'] = NULL;
$_SESSION['id_perfil'] = NULL;
$_SESSION['nombre_usuario'] = NULL;
$_SESSION['correo_usuario'] = NULL;
$_SESSION['clave_usuario'] = NULL;
$_SESSION['activo'] = NULL;


unset($_SESSION['id_usuario']) ;
unset($_SESSION['id_perfil']) ;
unset($_SESSION['nombre_usuario']) ;
unset($_SESSION['correo_usuario']) ;
unset($_SESSION['clave_usuario']) ;
unset($_SESSION['activo']) ;

if ($destino != "") {header("Location: $destino");
    exit;
}