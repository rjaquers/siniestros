<?php
//Descripción: administra si el usuario se logueo o no en la página de inicio
//Fecha: 24 julio 2022
//Solicitado por: Rodrigo Jaque
//Perfiles
// 1 = Administrador
// 2 = Asesores
// 3 = Clientes

if (!isset($_SESSION)) {
    ini_set("session.gc_maxlifetime", "7200");
    ini_set("session.cookie_lifetime", "7200");
    session_start();
}
 //$MM_donotCheckaccess = "false";
// *** Restringir el acceso a la página: Otorgar o denegar el acceso a esta página
function isAuthorized( $perfil_autorizado, $correo_usuario, $id_perfil)
{
    // Por seguridad, comience asumiendo que el visitante NO está autorizado.
    $isValid = false;
    // Cuando un visitante ha iniciado sesión en este sitio, la variable de sesión MM_Username se establece igual a su nombre de usuario.
    // Por lo tanto, sabemos que un usuario NO está conectado si esa variable de sesión está en blanco.
    if (!empty($correo_usuario)) {
        // O bien, puede restringir el acceso solo a ciertos usuarios en función de su grupo de usuario.
        //Perfiles autoriados, puede ser 1,2 o 3 o combinación de estos
        $perfiles_autorizados = Explode(",", $perfil_autorizado);
        if (in_array($id_perfil, $perfiles_autorizados)) {
            $isValid = true;
        }
    }
    return $isValid;
}

/// Fin funcion isAuthorized


//Destinos de perfiles No Autorizados
switch ($perfil_autorizado) {
    case '1':
        //Adinistrador
        $destino_x_perfil = "index2_asesor.php?titulo_pagina=Home";
         $_SESSION['home'] =  "home_admin.php";
        break;
    case '2':
        //Operador
        $destino_x_perfil = "index3_cliente.php?titulo_pagina=Home";
        $_SESSION['home'] =  "home_asesor.php";
        break;
    case '3':
        // Cliente
        $destino_x_perfil = "exit.php";
         $_SESSION['home'] =  "home_cliente.php";
        break;
}


//Modifgicación realizada el 3 de octubre de 2022, para poder asignar los links internos.
if(isset($_SESSION['id_perfil'])) {
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
}




if (!((isset($_SESSION['nombre_usuario'])) && (isAuthorized(  $perfil_autorizado, $_SESSION['correo_usuario'], $_SESSION['id_perfil'])))) {
    $inicio_variables = "?";
    $pag_solicita_validacion = $_SERVER['PHP_SELF'];
    if (strpos($destino_x_perfil, "?")) {
        $inicio_variables = "&";
    }
    if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) {
        $pag_solicita_validacion .= "?".$_SERVER['QUERY_STRING'];
    }
    $destino_final = $destino_x_perfil.$inicio_variables."url_solicitada=".urlencode($pag_solicita_validacion);
    header("Location: ".$destino_final);
    exit;
}