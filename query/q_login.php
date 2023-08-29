<?php
//Descripción: Crea la sesión de un usuario.
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
include_once("../c_connections/conec6.php");
if (! isset($_SESSION)) {
    session_start();
}
$destino = $_SERVER['PHP_SELF'];
// verificar si el usuario ya había ingresado
if (isset($_POST['url_solicitada'])) {
    $_SESSION['url_solicitada'] = $_POST['url_solicitada'];
}
//declaro variables de entorno.
$url_usuario_valido = "../index.php";


$url_usuario_NO_valido = "../f_login.php";
//Si existe el formulario, empezamos a hacer validaciones
if (isset($_POST['id_formulario']) and $_POST['id_formulario'] == 100) {
    $usuario = trim(filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_EMAIL));
    $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
    //definimos el destino del usuario si es valido o no.
    //Consulta SQl
    if (isset($conec6)) {
        $q_login = sprintf(
            "SELECT `id_usuario`, `id_perfil`, `nombres_usuario`, `correo_usuario`, `clave_usuario` , `activo` 
                            FROM `tbl_usuarios` WHERE `correo_usuario` = '%s'  ",
            $usuario
        );
        $re_login = mysqli_query($conec6, $q_login) or die(mysqli_errno($conec6)."Error X1 : $q_login ");
        $total_usuarios = mysqli_num_rows($re_login);
        if ($total_usuarios) {
            $row_login = mysqli_fetch_array($re_login, MYSQLI_ASSOC);
            $login_id_usuario = $row_login["id_usuario"];
            $login_id_perfil = $row_login["id_perfil"];
            $login_nombre_usuario = $row_login["nombres_usuario"];
            $login_correo_usuario = $row_login["correo_usuario"];
            $login_clave_usuario = $row_login["clave_usuario"];
            $login_activo = $row_login["activo"];

            //si el usuario existe, verifico que esté activo.
            if ($login_activo == 1) {
                include_once("../c_connections/funciones.php");
                //validamos la clave del usuario es valida
                $compara_claves = fn_verificaPaswordHash($password, $login_clave_usuario);
                if ($compara_claves == 1) {
                    $q_ingresos = sprintf("INSERT INTO `tbl_ingresos` (`id_usuario`) VALUES (%d);", $login_id_usuario);
                    $rs_update = mysqli_query($conec6, $q_ingresos) or die(mysqli_errno($conec6)."Error X2 : $q_ingresos ");

                    if (PHP_VERSION >= 5.1) {
                        session_regenerate_id(true);
                    } else {
                        session_regenerate_id();
                    }
                    $_SESSION['id_usuario'] = $login_id_usuario;
                    $_SESSION['id_perfil'] = $login_id_perfil;
                    switch ($_SESSION['id_perfil']) {
                        case 1:
                            $_SESSION['nombre_perfil'] = 'Administrador';
                            break;
                        case 2:
                            $_SESSION['nombre_perfil'] = 'Asesor';
                            break;
                        case 3:
                            $_SESSION['nombre_perfil'] = 'Cliente';
                            break;
                    }
                    $_SESSION['nombre_usuario'] = $login_nombre_usuario;
                    $_SESSION['correo_usuario'] = $login_correo_usuario;
                    $_SESSION['clave_usuario'] = $login_clave_usuario;
                    $_SESSION['activo'] = $login_activo;

                    switch ($_SESSION['id_perfil']) {
                        case 1:
                            $_SESSION['home'] = "home_admin.php";
                            break;
                        case 2:
                            $_SESSION['home'] = "home_asesor.php";
                            break;
                        case 3:
                            $_SESSION['home'] = "home_cliente.php";
                            break;
                    }


                    if (isset($_SESSION['url_solicitada']) && false) {
                        //si existe una página lo devuelvo a la que solicitó esta validación
                        $url_usuario_valido = $_SESSION['url_solicitada'];
                        $_SESSION['valido'] = 1;
                        // header("Location: ".$url_usuario_valido);
                    } else {
                        //si NO existe una página asumo que es usuario nuevo que entró por el login
                        $_SESSION['valido'] = 1;
                         header("Location: ".$url_usuario_valido."?id_sesion=".session_id() );
                    }
                } else { // compara claves
                    $_SESSION['valido'] = 0;
                    $error =  "la clave no coincide con la registrada en el sistema : ".$compara_claves;
                    header("Location: ".$url_usuario_NO_valido."?error=".$error);
                }
            } else {
                $error = "Usuario no activo";
                header("Location: ".$url_usuario_NO_valido."?error=".$error);
            } // login activo   }
        } else {
            $error = "Usuario no encontrado";
            header("Location: ".$url_usuario_NO_valido."?error=".$error);
        } // total de usuarios
    } else {
        $error = "Validación de Base de datos inactiva";
        header("Location: ".$url_usuario_NO_valido."?error=".$error);
    } // conexión a base de datos inactiva
} else {
    $error =  "El usuario no llego desde el formulario";
    header("Location: ".$url_usuario_NO_valido."?error=".$error);
}
