<?php
// Rodrigo Jaque Escobar Fono +56961405440 Creado en Septiembre de 2016
// funciones
date_default_timezone_set('America/Santiago');
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
error_reporting(E_ERROR | E_WARNING | E_PARSE);
error_reporting(E_ALL);
ini_set('display_errors', 1);
$query_setLocalTime = "SET lc_time_names = 'es_CL' ";
//if(isset($conec6)) {
//    $result_setLocalTime = mysqli_query($conec6, $query_setLocalTime);
//} else
//{
//    include_once($conec6);
//    $result_setLocalTime = mysqli_query($conec6, $query_setLocalTime);
//}

$currentPage = $_SERVER["PHP_SELF"];
$editFormAction = $_SERVER['PHP_SELF'];
ini_set('date.timezone', 'America/Santiago');
$hoy = date("Y-m-d");
$primerDiaMes = date('Y-m-01');
$ultimoDiaMes = date('Y-m-t');
$tiempo = time();
setlocale(LC_ALL, 'es_CL');

if (isset($_SERVER['HTTP_REFERER'])) {
    $varUrlOrigen = $_SERVER['HTTP_REFERER'];
//    header("Location: " . $varUrlOrigen);
}
if (isset($_GET['idEmpresa'])) {
    $idEmpresa = $_GET['idEmpresa'];
}





if(!function_exists("fn_cliente_registrado"))
{
    //revisa si una patente tiene un cliente registrado, sino retorna 0
    function fn_cliente_registrado($id_patente)
    {
        include('conec6.php');
            $id_patente = trim(filter_input(INPUT_GET, 'id_patente', FILTER_SANITIZE_NUMBER_INT));
            if (isset($conec6)) {
                $q_sql = sprintf("SELECT `id_asegurado` FROM `tbl_patentes` WHERE `id_patente` = %d", $id_patente);
                $re_sql = mysqli_query($conec6, $q_sql) or die(mysqli_error($conec6)." - Error 100 $q_sql");
                $row_sql = mysqli_fetch_assoc($re_sql);


                if (isset($row_sql['id_asegurado']) and ($row_sql['id_asegurado'] != '')) {
                    //return  $q_sql;
                    return $row_sql['id_asegurado'];

                } else {
                    //return $q_sql;;
                    return 0;
                }
                mysqli_free_result($re_sql);
                mysqli_close($conec6);
            } else {
                return "Error 100";
            }
    }
}




//Obtiene nro de siniestro por patente
if (!function_exists("fn_nombre_estado")) {
    function fn_nombre_estado($id_estado)
    {
        include('conec6.php');
        $sql = "";
        $sql = sprintf("SELECT `nombre` FROM `tbl_estados` WHERE `id_estado` = '%s' ", $id_estado);
        $re_sql = mysqli_query($conec6, $sql) or die (mysqli_error($conec6).$sql);
        $row_sql = mysqli_fetch_assoc($re_sql);
        if (isset($row_sql['nombre'])) {
            //$retorno =
            return $row_sql['nombre'];
        } else {
            return "Sin Datos";
        }
    }
}




//Crea un registro por cada cambio de estado de un siniestro
if (! function_exists("fn_reg_estado_siniestro")) {
    function fn_reg_estado_siniestro($id_siniestro, $id_estado, $id_usuario)
    {
        //include_once("../c_connections/conec7.php");
        include('conec6.php');
        $sql = "";
        $sql = sprintf( "INSERT INTO `tbl_estados_historial` (  `id_siniestro`, `id_estado`, `id_usuario`) 
             VALUES (  %d, %d, %d)",
            $id_siniestro, $id_estado, $id_usuario  );
        $result = mysqli_query($conec6, $sql) or die (mysqli_error($conec6).$sql);
    }

}






//Obtiene nro de siniestro por patente
if (! function_exists("fn_id_patente")) {
    function fn_id_patente($patente)
    {
        include('conec6.php');
        $sql = "";
        $sql = sprintf("SELECT `id_patente` FROM `tbl_patentes` WHERE `patente` = '%s' ", $patente);

        $re_sql = mysqli_query($conec6, $sql) or die (mysqli_error($conec6).$sql);
        $row_sql = mysqli_fetch_assoc($re_sql);
        if (isset($row_sql['id_patente'])) {
            $retorno = $row_sql['id_patente'];

            return $retorno;
        } else {
            return "Sin Datos";
        }
    }
}



//Obtiene nro de siniestro por patente
if (! function_exists("fn_id_siniestro")) {
    function fn_id_siniestro($patente)
    {
        include('conec6.php');
        $sql = "";
        $sql = sprintf("SELECT  `id_siniestro`  FROM `tbl_siniestros` WHERE `patente` =  '%s'", $patente);
        $re_sql = mysqli_query($conec6, $sql) or die (mysqli_error($conec6).$sql);
        $row_sql = mysqli_fetch_assoc($re_sql);
        if (isset($row_sql['id_siniestro'])) {
            $retorno = $row_sql['id_siniestro'];

            return $retorno;
        } else {
            return "Sin Datos";
        }
    }
}

//Obtiene nro de siniestro por ic
if (! function_exists("fn_nro_siniestro")) {
    function fn_nro_siniestro($id_siniestro)
    {
        include('conec6.php');
        $sql = "";
        $sql = sprintf("SELECT  `nro_siniestro`  FROM `tbl_siniestros` WHERE `id_siniestro` =  %d", $id_siniestro);
        $re_sql = mysqli_query($conec6, $sql) or die (mysqli_error($conec6).$sql);
        $row_sql = mysqli_fetch_assoc($re_sql);
        if (isset($row_sql['nro_siniestro'])) {
            $retorno = $row_sql['nro_siniestro'];

            return $retorno;
        } else {
            return "Sin Datos";
        }
    }
}

//Obtiene patente
if (! function_exists("fn_patente_x_id")) {
    function fn_patente_x_id($id_patente)
    {
        include('conec6.php');
        $sql = "";
        $sql = sprintf("SELECT   `patente` FROM `tbl_patentes` WHERE `id_patente` =  %d", $id_patente);
        $re_sql = mysqli_query($conec6, $sql) or die (mysqli_error($conec6).$sql);
        $row_sql = mysqli_fetch_assoc($re_sql);
        if (isset($row_sql['patente'])) {
            $retorno = $row_sql['patente'];

            return $retorno;
        } else {
            return "Sin Datos";
        }
    }
}

//Obtiene el Nombre de Usuario
if (! function_exists("fn_nombre_usuario")) {
    function fn_nombre_usuario($id_usuario)
    {
        include('conec6.php');
        if (! mysqli_select_db($conec6, $database_conec)) {
            echo 'No se pudo seleccionar la base de datos';
            exit;
        }
        $sql = "";
        $sql = sprintf("SELECT `nombres_usuario` FROM `tbl_usuarios` WHERE `id_usuario` = %d", $id_usuario);
        $re_sql = mysqli_query($conec6, $sql) or die (mysqli_error($conec6).$sql);
        $row = mysqli_fetch_row($re_sql);
        if (isset($row[0])) {
            $resultado = $row[0];
            return $resultado;
        } else {
            return "Sin Datos";
        }

        if (! $result) {
            echo 'No se puede ejecutar la consulta: '.mysqli_error($conec6)."Error Fx14 ".$sql;
            exit;
        }
        [$nombre] = mysqli_fetch_row($result);
        if (! empty($nombre)) {
            return $nombre;
        };
    }
}

//Busca el nombre del perfil en la base de datos
//Rodrigo Jaque Escobar
// Fecha: 27 de julio de 2022
if (! function_exists("fn_nombre_perfil")) {
    function fn_nombre_perfil($id_perfil)
    {
        require('conec6.php');
        $q_sql = sprintf("SELECT  `nombre_perfil`  FROM `tbl_perfil` WHERE `id_perfil` =   %d   ", $id_perfil);
        $re_sql = mysqli_query($conec6, $q_sql) or die(mysqli_errno($conec6)."Error Fx43 ".$q_sql);
        $row = mysqli_fetch_row($re_sql);
        if (isset($row[0])) {
            $resultado = $row[0];

            return $resultado;
        } else {
            return "Sin Datos";
        }
        //mysqli_free_result($re_sql);
        //mysqli_close($conec6);
    }
}

//Verica que la clave esté buena.
//Rodrigo Jaque Escobar
// Fecha: 01 mayo 2018
if (! function_exists("fn_verificaPaswordHash")) {
    //function fn_verificaPaswordHash($correoUsuario, $claveUsuarioIngresada, $claveExistente) {
    function fn_verificaPaswordHash($claveUsuarioIngresada, $claveExistente)
    {
        include("conec6.php");
        //limpio la clave ingresada por el usuario
        $original = mysqli_real_escape_string($conec6, $claveUsuarioIngresada);

        //Luego comparamos la clave registrada con la clave que escribió con Password_verify
        $iguales = password_verify($original, $claveExistente);
        // si son iguales de damos acceso.
        if ($iguales) {
            return '1';
        } else {
            return '0';
        }
    }
}
// fin

//Inicio//////////////////////////////////////////////////
// Enviar Mail
function fn_enviar_mail_recupera_clave($correo, $clave)
{
    $para = $correo;
    $titulo = "Envío de clave Siniestros HyV "."\r\n";
    $mensaje = "Se ha cambiado su clave de acceso a Siniestros HyV \r\n";
    $mensaje .= "Su Usuario es: ".$correo."\r\n";
    $mensaje .= "Su clave de acceso es: ".$clave."\r\n";
    $mensaje .= " - - - - - - - - - - - - - - - - - - - - - - - - - - - \r\n";
    $mensaje .= "https://www.hyv.cl/siniestros/f_login.php";
    $cabeceras = "From: soporte@hyv.cl"."\r\n"."Reply-To: noresponder@hyv.cl"."\r\n".'Bcc:   rjaquers@gmail.com'."\r\n"."X-Mailer: PHP/".phpversion();
    mail($para, $titulo, $mensaje, $cabeceras);

    return true;
}

//Genera Una clave aleatoria para usuarios que desean cambiar la suya
if (! function_exists("generaPass")) {
    function fn_generaPass()
    {
        //Se define una cadena de caractares. Te recomiendo que uses esta.
        $cadena = "abcdefghijklmnopqrstuvwxyz1234567890";
        //Obtenemos la longitud de la cadena de caracteres
        $longitudCadena = strlen($cadena);

        //Se define la variable que va a contener la contraseña
        $pass = "";
        //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
        $longitudPass = 12;

        //Creamos la contraseña
        for ($i = 1; $i <= $longitudPass; $i++) {
            //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
            $pos = rand(5, $longitudCadena - 1);

            //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
            $pass .= substr($cadena, $pos, 1);
        }

        return $pass;
    }
}

//Mensaje a nuevo usuario
if (!function_exists("fn_mail_nuevo_usuario")) {
    function fn_mail_nuevo_usuario($correo, $clave)
    {
        $para = $correo;
        $titulo = "Registro en Siniestros"."\r\n";
        $mensaje = "Usted ha sido invitado a usar el sistema de Siniestros de HyV: <br> Los datos son los siguientes\r\n";
        $mensaje .= "Su Usuario es: ".$correo."\r\n";
        $mensaje .= "Su clave de acceso es: ".$clave."\r\n";
        $mensaje .= " - - - - - - - - - - - - - - - - - - - - - - - - - - - \r\n";
        $mensaje .= "https://www.hyv.cl/siniestros/f_login.php";
        $cabeceras = "From: soporte@hyv.cl"."\r\n"."Reply-To: noresponder@hyv.cl"."\r\n".'Bcc:   rjaquers@gmail.com'."\r\n"."X-Mailer: PHP/".phpversion();

        //mail($para, $titulo, $mensaje, $cabeceras);

        try {
            mail($para, $titulo, $mensaje, $cabeceras);
            } catch (Throwable $e)
            {
                echo $e->getMessage();
             }
        return true;
    }
}



if (! function_exists("fn_nombreMes")) {
    function fn_nombreMes($mes)
    {
        switch ($mes) {
            case 1:
                return "Enero";
                break;
            case 2:
                return "Febrero";
                break;
            case 3:
                return "Marzo";
                break;
            case 4:
                return "Abril";
                break;
            case 5:
                return "Mayo";
                break;
            case 6:
                return "Junio";
                break;
            case 7:
                return "Julio";
                break;
            case 8:
                return "Agosto";
                break;
            case 9:
                return "Septiembre";
                break;
            case 10:
                return "Octubre";
                break;
            case 11:
                return "Noviembre";
                break;
            case 12:
                return "Diciembre";
                break;
            default:
                return "Sin datos";
                break;
        }
    }
}

//Coloca puntitos a los numeros
function coloca_puntitos($numero)
{
    $valor_con_puntos = number_format($numero, 0, ',', '.');

    return $valor_con_puntos;
}

//// Crea registro de errores
if (! function_exists("fn_toLog")) {
    function fn_toLog($msg, $id_usuario)
    {
        $hoy = date("Y-m-d");
        $date = date('Y-m-d H:i:s');
        $varAnio = date('Y');
        $varMes = date('m');
        $vardia = date('d');
//        $varCobrador = intval();
        $directorio = "c_log/accesos/$varAnio/$varMes/$vardia/";

        if (file_exists($directorio)) {
            $URLDestino = $directorio."registro_movimientos.log";
            $file = fopen($URLDestino, "a+");
            fwrite($file, $date."-> ".$msg.";".PHP_EOL);
        } else {
            mkdir($directorio, 0777, true);
            $URLDestino = $directorio."registro_movimientos.log";
            $file = fopen($URLDestino, "a+");
            fwrite($file, $date."-> Id Usuario : ".$id_usuario." / SQL: ".$msg.PHP_EOL);
        }
        fclose($file);
    }
}

//Obtener la io Real de un usuario //Obtener la io Real de un usuario
//Rodrigo Jaque Escobar
// Fecha: 14 sept 2021
if (! function_exists("fn_iPUsuario")) {
    function fn_iPUsuario()
    {
        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            return $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
            return $_SERVER["HTTP_X_FORWARDED"];
        } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_FORWARDED"])) {
            return $_SERVER["HTTP_FORWARDED"];
        } else {
            return $_SERVER["REMOTE_ADDR"];
        }
    }
}

////Limpia o elimina los puntos que aparezcan en una cadena cualquiera, por ejemplo en el rut.
if (! function_exists("fn_limpiapuntosRut")) {
    function fn_limpiapuntosRut($var1)
    {
        $patron = ".";    //<---- asi
        $cadena_nueva = str_replace($patron, "", $var1);

        return $cadena_nueva;
    }
}
//

function fn_iconoExtensionArchivo($path)
{
    $extension = substr(strrchr($path, "."), 1);
    switch ($extension) {
        case 'application/pdf':
            $icono = "<i class='far fa-file-pdf'></i>";
            break;
        case 'pdf':
            $icono = "<i class='far fa-file-pdf'></i>";
            break;
        case 'text/comma-separated-values':
            $icono = "<i class='fas fa-file-csv'></i>";
            break;
        case 'csv':
            $icono = "<i class='fas fa-file-csv'></i>";
            break;
        case 'image/jpeg':
            $icono = "<i class='far fa-file-image'></i>";
            break;
        case 'jpeg':
            $icono = "<i class='far fa-file-image'></i>";
            break;
        case 'image/png':
            $icono = "<i class='fas fa-file-image'></i>";
            break;
        case 'png':
            $icono = "<i class='fas fa-file-image'></i>";
            break;
        case 'image/gif':
            $icono = "<i class='fas fa-file-image'></i>";
            break;
        case 'gif':
            $icono = "<i class='fas fa-file-image'></i>";
            break;
        case 'message/rfc822':
            $icono = "<i class='fas fa-at'></i>";
            break;
        case 'application/octet-stream':
            $icono = "<i class='far fa-file-excel'></i>";
            break;
        case 'xlsx':
            $icono = "<i class='far fa-file-excel'></i>";
            break;
        case 'application/msword':
            $icono = "<i class='far fa-file-word'></i>";
            break;
        case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
            $icono = "<i class='far fa-file-excel'></i>";
            break;
        case 'application/vnd.ms-excel':
            $icono = "<i class='far fa-file-excel'></i>";
            break;
        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
            $icono = "<i class='far fa-file-excel'></i>";
            break;
        default:
            $icono = "<i class='fas fa-file-download'></i>";
    }

    return $icono;
}

//
//

function fn_reconocerExtensionArchivo($extension)
{
    switch ($extension) {
        case 'application/pdf':
            $extension = "pdf";
            break;
        case 'text/comma-separated-values':
            $extension = 'csv';
            break;
        case 'image/jpeg':
            $extension = 'jpg';
            break;
        case 'image/png':
            $extension = 'png';
            break;
        case 'image/gif':
            $extension = 'gif';
            break;
        case 'message/rfc822':
            $extension = 'eml';
            break;
        case 'application/octet-stream':
            $extension = 'xlsx';
            break;
        case 'application/msword':
            $extension = 'doc';
            break;
        case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
            $extension = 'xlsx';
            break;
        case 'application/vnd.ms-excel':
            $extension = 'xls';
            break;
        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
            $extension = 'docx';
            break;
    }

    return $extension;
}

//
//// ===============================================================================================================

//
//
//
//
//// ===============================================================================================================
////100 Rodrigo Jaque Escobar 01 mayo 2018
////Obtiene la fecha e dia/mes/año español
if (! function_exists("fn_fechaConHora")) {
    function fn_fechaConHora($fechaEnviada)
        // devuelve la fecha en format miercoles, 12 de enero de 2007
    {
        if ($fechaEnviada <> "") {
            //  setlocale(LC_ALL, 'es-cl');
            setlocale(LC_ALL, 'es_es');
            $fechaSinHora = strftime("%d/%b/%y | %T", strtotime($fechaEnviada));

            return $fechaSinHora;
        } else {
            return "-";
        }
    }
}
//////////////////////////////////////////////////////
//
//
////Calcular fecha mas n dias
function fn_fechaActualmasXdias($xdias)
{
    $fecha_actual = date("d-m-Y");

    //sumo 1 día
    return date("Y-m-d", strtotime($fecha_actual."+ $xdias days"));
}

//
//
//// ===============================================================================================================
////100 Rodrigo Jaque Escobar 01 mayo 2018
////Obtiene la fecha e dia/mes/año español
if (! function_exists("fn_fechaSinHora")) {
    function fn_fechaSinHora($fechaEnviada)
        // devuelve la fecha en format miercoles, 12 de enero de 2007
    {
        if ($fechaEnviada <> "") {
            //  setlocale(LC_ALL, 'es-cl');
            setlocale(LC_ALL, 'es_es');
            $fechaSinHora = strftime("%d/%b/%y", strtotime($fechaEnviada));

            return $fechaSinHora;
        } else {
            return "-";
        }
    }
}
//////////////////////////////////////////////////////
//
//
//// diferencia entre dos fecha
function diferenciaFechas($date1, $date2)
{
    if (! is_integer($date1)) {
        $date1 = strtotime($date1);
    }
    if (! is_integer($date2)) {
        $date2 = strtotime($date2);
    }

    return floor(abs($date1 - $date2) / 60 / 60 / 24);
}

//
//
////calcular digito verificador
function dv($r)
{
    $s = 1;
    for ($m = 0; $r != 0; $r /= 10) {
        $s = ($s + $r % 10 * (9 - $m++ % 6)) % 11;
    }
    echo '', chr($s ? $s + 47 : 75);
}

//
//

//
//
if (! function_exists("tolog")) {
    function tolog($msg)
    {
        $date = date('d.m.Y h:i:s.u');
        error_log($date." ".$msg."\n", 3, "FUNCIONES_LOG.log");
    }
}

//
////calcular la cantidad de dias en el mes
function TotalDiasMes($anio, $mes)
{
    $número = cal_days_in_month(CAL_GREGORIAN, $mes, $anio); // 31

    return $número;
}

//
//
//// ===============================================================================================================
//

//
//
//Cuantos Dias tiene el mes
function DiasFaltanfinDeMes($dia, $Mes, $Anio)
{
    $TotalDiasDelMes = cal_days_in_month(CAL_GREGORIAN, $Mes, $Anio);
    $RestaDias = $TotalDiasDelMes - $dia;

    return $RestaDias;
}

//
//
function ObtenerFechaAnio($id)
// devuelve la fecha en format miercoles, 12 de enero de 2007
{
    setlocale(LC_ALL, 'es-cl');
    $fecha = strftime("%Y", strtotime($id));

    return "$fecha";
}

//
function ObtenerFechaMes($id)
// devuelve la fecha en format miercoles, 12 de enero de 2007
{
    setlocale(LC_ALL, 'es-cl');
    $fecha = strftime("%m-%Y", strtotime($id));

    return "$fecha";
}

//
/////////////////////////////////////////////////////
function ObtenereFechaSinhora($id)
// devuelve la fecha en format miercoles, 12 de enero de 2007
{
    setlocale(LC_ALL, 'es-cl');
    $fecha = strftime("%d-%b-%Y", strtotime($id));

    return "$fecha";
}

//
//////////////////////////////////////////////////////
function fn_fecha_corta($id)
// devuelve la fecha en format miercoles, 12 de enero de 2007
{
    setlocale(LC_ALL, 'es-cl');
    $fecha = strftime("%d-%b-%Y %T", strtotime($id));

    return "$fecha";
}

//
//////////////////////////////////////////////////////
function ObtenereFechaLarga($id)
// devuelve la fecha en format miercoles, 12 de enero de 2007
{
    setlocale(LC_ALL, 'es-cl');
    $fecha = strftime("%A , %d de %B de %Y ", strtotime($id));

    return "$fecha";
}

//
//////////////////////////////////////////////////////
function ObtenereFechaenespaniol($id)
// devuelve la fecha en format miercoles, 12 de enero de 2007
{
    setlocale(LC_ALL, 'es-cl');
    $fecha = strftime("%A, %d-%b-%Y ", strtotime($id));

    return "$fecha";
}

//
////Inicio//////////////////////////////////////////////////
function Fecha_hoy()
{
    setlocale(LC_ALL, 'esp_esp');
    $fecha_hoy = date('Y-m-d');

    return $fecha_hoy;
}

//
////Inicio//////////////////////////////////////////////////

//
////Inicio//////////////////////////////////////////////////
function saca_puntitos($numero)
{
    $vocales = [".", ","];
    $resultadoarreglo = str_replace($vocales, "", "$numero");

    return $resultadoarreglo;
}

//
////Inicio//////////////////////////////////////////////////
//// Enviar Mail
function fn_enviarmailRecClave($correo, $clave, $varusuario)
{
    $para = $correo;
    $titulo = "Envío de clave Siniestros HyV "."\r\n";
    $mensaje = "Se ha cambiado su clave de acceso a Siniestros HyV \r\n";
    $mensaje .= "Su Usuario es: ".$varusuario."\r\n";
    $mensaje .= "Su clave de acceso es: ".$clave."\r\n";
    $mensaje .= " - - - - - - - - - - - - - - - - - - - - - - - - - - - \r\n";
    $mensaje .= "https://www.blue-box.cl/wms/a_login.php";
    $cabeceras = "From: wms@blue-box.cl"."\r\n"."Reply-To: noresponder@blue-box.cl"."\r\n".'Bcc: m.sotz@nlnexus.com, rodrigo.jaque@blue-box.cl'."\r\n"."X-Mailer: PHP/".phpversion(
        );
    mail($para, $titulo, $mensaje, $cabeceras);

    return true;
}

//Tarea Encuentra el nombre de un archivo si existe
//Rodrigo Jaque Escobar
// Fecha: 14 sept 2021
function url_exists($nombre_fichero)
{
    if (file_exists($nombre_fichero)) {
        echo "El fichero existe: $nombre_fichero";
    } else {
        echo "El fichero no existe: $nombre_fichero";
    }
}




//Requiere el nombre de la página que lo llama
//Rodrigo Jaque Escobar
// Fecha: 14 sept 2021
//if (!function_exists("fn_DatosUsuarios")) {
//    function fn_DatosUsuarios($nombrePaginaqueLlama, $accionUsuario)
//        //quiero registrar el usuario, el pais, la ip
//    {
//        include('conec5.php');
//        $info['accionUsuario'] = $accionUsuario;
//        $browser = array("IE", "OPERA", "MOZILLA", "NETSCAPE", "FIREFOX", "SAFARI", "CHROME");
//        $os = array("WIN", "MAC", "LINUX");
//        # definimos unos valores por defecto para el navegador y el sistema operativo
//        $info['browser'] = "OTHER";
//        $info['os'] = "OTHER";
//        # buscamos el navegador con su sistema operativo
//        foreach ($browser as $parent) {
//            $s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
//            $f = $s + strlen($parent);
//            $version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
//            $version = preg_replace('/[^0-9,.]/', '', $version);
//            if ($s) {
//                $info['browser'] = $parent;
//                $info['version'] = $version;
//            }
//        }
//        # obtenemos el sistema operativo
//        foreach ($os as $val) {
//            if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $val) !== false) {
//                $info['os'] = $val;
//            }
//        }
//
//        # obtenemos el pais
//        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
//            $ip = $_SERVER['HTTP_CLIENT_IP'];
//        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
//            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
//        } else {
//            $ip = $_SERVER['REMOTE_ADDR'];
//        }
//        // $url = "http://api.wipmania.com/".$ip;
//        $url = "http://www.geoplugin.net/json.gp?ip=" . $ip;
//        //$info['paisAcceso'] = file_get_contents($url);
//        $info['paisAcceso'] = 'CL';
//        # obtenemos la IP
//
//        # devolvemos el array de valores
//        //return $info;
//
//        //así se llama
//        $info['ipAcceso'] = fn_iPUsuario();
//
//
//        $insertSQLtxt = sprintf(" | Usuario` = '%s' | `nombre Usuario` = '%s'  |   `IP Acceso` = '%s' | `SO Acceso` = '%s' | `Navegador Acceso` =' %s' | `Version Navegador` = '%s' | `nombre Pagina url Acceso` = '%s' | `Sesion IDAcceso` = '%s' | `accion Usuario` = '%s' |)",
//                                $_SESSION['idUsuario'],
//                                $_SESSION['nombres'],
//                                $info['ipAcceso'],
//                                $info["os"],
//                                $info["browser"],
//                                $info["version"],
//                                $nombrePaginaqueLlama,
//                                session_id(),
//                                $info['accionUsuario'] );
//
//        $insertSQL = sprintf("INSERT INTO `tbl_logUsuarios` (`idUsuario`, `nombreUsuario`,    `IPAcceso`, `SOAcceso`, `NavegadorAcceso`,
//`VersionNavegador`,  `nombrePaginaurlAcceso`, `SesionIDAcceso`, `accionUsuario`) VALUES ( '%s', '%s','%s','%s','%s','%s','%s','%s', '%s')",
//                             $_SESSION['idUsuario'],
//                             $_SESSION['nombres'],
//                             $info['ipAcceso'],
//                             $info["os"],
//                             $info["browser"],
//                             $info["version"],
//                             $nombrePaginaqueLlama,
//                             session_id(),
//                             $info['accionUsuario'] );
//
//        //	die($insertSQL);
//
//        // ===============================================================================================================
//        //100 Rodrigo Jaque Escobar 01 mayo 2018
//        //Inserta el mensaje en un archivo de texto.
//        fn_toLog($insertSQLtxt);
//        mysqli_select_db($conec6, $database_conec) or die(mysqli_errno($conec6) . "Error Fx10");
//        $Result1 = mysqli_query($conec6, $insertSQL);
//    }
//
//}

//
//
////Buscar nombre operador
//if (!function_exists("fn_nombreUsuario")) {
//    function fn_nombreUsuario($var1)
//    {
//        include('conec5.php');
//        $q_sql = sprintf("SELECT `nombres`  FROM `tbl_usuarios` WHERE  `idUser` = '%s'", $var1);
//        $re_sql = mysqli_query($conec6, $q_sql) or die(mysqli_errno($conec6) . "Error Fx43 " . $q_sql);
//        $row = mysqli_fetch_row($re_sql);
//        if (isset($row[0])) {
//            $retorno = $row[0];
//            return $retorno;
//        } else {
//            return "Sin Datos";
//        }
//        mysqli_free_result($re_sql);
//        mysqli_close($conec6);
//    }
//}
//
////Buscar nombre operador

//
//

//
//
////Saber el nombre de un cliente
//if (!function_exists("fn_nombreDestinatario")) {
//    function fn_nombreDestinatario($id_destinatario )
//    {
//        include('conec5.php');
//        $q_sql = sprintf("SELECT   `nombreDest`  FROM `tbl_destinatario` WHERE `idDestinatario`  = %d", $id_destinatario);
//        $re_sql = mysqli_query($conec6, $q_sql) or die(mysqli_errno($conec6) . "Error Fx50 " . $q_sql);
//        $row = mysqli_fetch_row($re_sql);
//
//        if (isset($row[0])  ) {
//            $retorno = $row[0];
//            return $retorno;
//        } else {
//            return 'Sin Datos';
//        }
//        mysqli_free_result($re_sql);
//        mysqli_close($conec6);
//    }
//}

//Obtener la io Real de un usuario //Obtener la io Real de un usuario
//Rodrigo Jaque Escobar
// Fecha: 14 sept 2021

// // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // //
// // // // // // // // // // // // // // // // // // // //

//
////Consulta Select código DUN
//if (!function_exists("fn_buscarStockMinimo")) {
//    function fn_buscarStockMinimo($codigoBarras)
//    {
//        include('conec5.php');
//        $q_query= sprintf("SELECT  `stockminimo` FROM `inventarioOriginal` WHERE  `codigoBarras` = '%s'   LIMIT 1 ", $codigoBarras);
//        $re_query = mysqli_query($conec6, $q_query) or die("Error Fx42 =>" . $q_query . " <= ".mysqli_errno($conec6)   );
//        $row = mysqli_fetch_array($re_query);
//        if (isset($row['stockminimo'])) {
//            return $row['stockminimo'] ;
//        } else {
//            return  'Sin Datos';
//        }
//        mysqli_free_result($re_sql);
//        mysqli_close($conec6);
//    }
//}
//
//
//
////Consulta Select código DUN
//if (!function_exists("fn_datosSucursal")) {
//    function fn_datosSucursal($idSucursal)
//    {
//        include('conec5.php');
//        $q_query= sprintf("SELECT  `nombreSucursal`,   `direccion`  , `userdef1` FROM `tblz_clientesSucursales` WHERE  `idSucursal` = %d   LIMIT 1 ", $idSucursal);
//        $re_query = mysqli_query($conec6, $q_query) or die("Error Fx42 =>" . $q_query . " <= ".mysqli_errno($conec6)   );
//        $row = mysqli_fetch_array($re_query);
//        if (isset($row['nombreSucursal'])) {
//            return $row['nombreSucursal'] ."<br> Dirección: ". $row['direccion'] ."<br> Contacto: ". $row['userdef1'] ;
//
//        } else {
////            return  $q_query;
//            return  'Sin Datos';
//        }
//        mysqli_free_result($re_sql);
//        mysqli_close($conec6);
//    }
//}
//
//
//
//
////Saber cual nave usa una empresa:
//
//if (!function_exists("fn_saberNaveEmpresa")) {
//    function fn_saberNaveEmpresa($idEmpresa)
//    {
//        include('conec5.php');
//
//        $q_empresa = '';
//        $q_empresa = sprintf("SELECT `idNave`  FROM `tbl_empresa` WHERE `idEmpresa` = %d  limit 1 ", $idEmpresa);
//        $re_empresa = mysqli_query($conec6, $q_empresa) or die("Error Fx31 =>" . $q_empresa . " <= ".mysqli_errno($conec6)   );
//        $row = mysqli_fetch_row($re_empresa);
//        if (isset($row[0])) {
//            $retorno = $row[0];
//            return $retorno;
//        } else {
//            return 0;
//        }
//        mysqli_free_result($re_rack);
//        mysqli_close($conec6);
//    }
//}
//
//// Buscar si una bodega ya fue asiganda a un cliente, le avisa al usuario
//if (!function_exists("fn_buscarBodegasOcupadas")) {
//    function fn_buscarBodegasOcupadas($idBodega, $idEmpresa)
//    {
//        include('conec5.php');
//
//        $q_rack = '';
//        $q_rack = sprintf("SELECT `idBE` FROM `tbl_bodegaEmpresa` WHERE `idBodega` = %d AND `idEmpresa` = %d  limit 1 ", $idBodega, $idEmpresa);
//        $re_rack = mysqli_query($conec6, $q_rack) or die("Error Fx31 =>" . $q_query . " <= ".mysqli_errno($conec6)   );
//        if (mysqli_num_rows($re_rack) > 0) {
//            return 1; // encontramos la bodega en la segunda tabla
//        } else
//        {
//            return 0; // NO encontramos la bodega en la segunda tabla
//        }
//        mysqli_free_result($re_rack);
//        mysqli_close($conec6);
//    }
//}
//
//
//
//
//
////Buscar el Id de empresa según el código de barra de un producto
//if (!function_exists("fn_buscaridEmpresaxCodBarra")) {
//    function fn_buscaridEmpresaxCodBarra($codigobarra)
//    {
//        include('conec5.php');
////        Limpia lo spuntos del rut
//
//        $q_query = sprintf("SELECT `idEmpresa` FROM `inventarioOriginal` WHERE `codigoBarras` = '%s'", $codigobarra);
//        $re_sql = mysqli_query($conec6, $q_query) or die(mysqli_errno($conec6) . "Error Fx30 " . $q_query);
//        $row = mysqli_fetch_row($re_sql);
//        if (isset($row[0])) {
//            $retorno = $row[0];
//            return $retorno;
//        } else {
//            return 0;
//        }
//        mysqli_free_result($re_sql);
//        mysqli_close($conec6);
//    }
//}
//
//
//
//// Buscar si un alias Rack está ocupado por algún objeto en la tabla tbl-packingListDetalle
//if (!function_exists("fn_aliasRackOcupado")) {
//    function fn_aliasRackOcupado($aliasRack)
//    {
//        include('conec5.php');
//        $varcodBarra = trim($aliasRack);
//        $q_rack = '';
//        $q_rack = sprintf("SELECT `idPackingListDetalle`, `codigoBarras` FROM `tbl-packingListDetalle` WHERE `aliasRack` LIKE '%s' AND `activo` = 'Y' AND `idBodega` != 9 ORDER BY `aliasRack` DESC limit 1 ", $aliasRack);
//        $re_rack = mysqli_query($conec6, $q_rack) or die("Error Fx29 =>" . $q_query . " <= ".mysqli_errno($conec6)   );
//        if (mysqli_num_rows($re_rack) > 0) {
//            $row_rack = mysqli_fetch_assoc($re_rack);
//            $varreturn = $row_rack['codigoBarras'];
//            return $varreturn;
//        } else
//        {
//            return "Vacio";
//        }
//        mysqli_free_result($re_rack);
//        mysqli_close($conec6);
//    }
//}
//
//
//
//
//
//
//
//
//
//if (!function_exists("fn_contarEstadoPickingxEmpresa")) {
//function fn_contarEstadoPickingxEmpresa($estado, $idEmpresa)
//{
//include('conec5.php');
//    $q_query = sprintf("SELECT COUNT( `estado` )  as total   FROM `tbl-picking` WHERE estado = '%s' AND  idEmpresa = %d AND `activo` = 'Y'  ", $estado, $idEmpresa);
//    $re_sql = mysqli_query($conec6, $q_query) or die("Error Fx28 =>" . $q_query . " <= ".mysqli_errno($conec6)   );
//    $row = mysqli_fetch_row($re_sql);
//    return $row[0];
//    mysqli_free_result($re_sql);
//    mysqli_close($conec6);
//}
//}
//
//
//
////Saber si existe Picking
//if (!function_exists("fn_buscarPickingxOrdenVenta")) {
//    function fn_buscarPickingxNotaVenta($ordenVenta)
//    {
//        include('conec5.php');
//        $q_query = sprintf("SELECT  count(`idPicking`) as total  FROM `tbl-picking` WHERE `nota_de_venta` LIKE '%s'", $ordenVenta);
//        $re_sql = mysqli_query($conec6, $q_query) or die("Error Fx27 =>" . $q_query . " <= ".mysqli_errno($conec6)   );
//        $row = mysqli_fetch_row($re_sql);
//        return $row[0];
//        mysqli_free_result($re_sql);
//        mysqli_close($conec6);
//
//    }
//}
//
//
//
//
//
//
//
//
//
//
//if (!function_exists("fn_nombreBodega")) {
//    function fn_nombreBodega($idBodega)
//    {
//        include('conec5.php');
//        $query_rscodigoAtlas = sprintf("SELECT `nombreBodega` FROM `tbl-bodega` WHERE  `idBodega` = %d ORDER BY `nombreBodega` DESC LIMIT 1 ", $idBodega);
//        if ($result_rscodigoAtlas = mysqli_query($conec6, $query_rscodigoAtlas)) {
//            $row = mysqli_fetch_row($result_rscodigoAtlas);
//            return $row[0];
//            mysqli_free_result($resultado);
//        } else {
//            return "Sin Datos";
//             die("Error Fx41 =>" . $q_query . " <= ".mysqli_errno($conec6)   );
//        }
//        mysqli_free_result($re_sql);
//        mysqli_close($conec6);
//    }
//}
//
//
//
//
//
//
////buscarla orden de compra se´´un orden e venta
//if (!function_exists("fn_buscarOrdendeCompra()")) {
//    function  fn_buscarOrdendeCompra($ordendeVenta)
//    {
//        include('conec5.php');
////        Limpia lo spuntos del rut
//
//        $q_query = sprintf("SELECT  `ordendeCompra` FROM `tbl_oventastxt` WHERE `ordenVenta` LIKE '%s' LIMIT 1 ", $ordendeVenta );
//        $re_sql = mysqli_query($conec6, $q_query) or die("Error Fx39 =>" . $q_query . " <= ".mysqli_errno($conec6)   );
//        $row = mysqli_fetch_row($re_sql);
//        return   $row[0];
//        mysqli_free_result($re_sql);
//        mysqli_close($conec6);
//    }
//}
//
//
//
//
//
//
//
////saber si un codigo Picking existe en la tabla tbl-picking
//if (!function_exists("fn_exiteCodPicking")) {
//    function fn_exiteCodPicking($codpicking)
//    {
//        include('conec5.php');
//        $q_query = sprintf("SELECT count(`codPicking`) as contador FROM `tbl-picking` WHERE `codPicking` LIKE '%s' ", $codpicking);
//        $re_sql = mysqli_query($conec6, $q_query) or die("Error Fx34 =>" . $q_query . " <= ".mysqli_errno($conec6)   );
//        $row = mysqli_fetch_row($re_sql);
//        return $row[0];
//        mysqli_free_result($re_sql);
//        mysqli_close($conec6);
//    }
//}
//
//
//// Saber el id de un cliente de sucursal
//if (!function_exists("fn_idSucursal")) {
//    function fn_idSucursal($rutcliente)
//    {
//        include('conec5.php');
//        $q_query = sprintf("SELECT `idSucursal` FROM `tblz_clientesSucursales` WHERE `rutSucursal` = '%s'", $rutcliente);
//        $re_sql = mysqli_query($conec6, $q_query) or die("Error Fx33 =>" . $q_query . " <= ".mysqli_errno($conec6)   );
//        $row = mysqli_fetch_row($re_sql);
//        if (isset($row[0])) {
//            $retorno = $row[0];
//            return $retorno;
//        } else {
//            return 1;
//        }
//        mysqli_free_result($re_sql);
//        mysqli_close($conec6);
//    }
//}
//
//if (!function_exists("fn_existeRutCliente")) {
//    function fn_existeRutCliente($rutcliente)
//    {
//        include('conec5.php');
//        $q_query = sprintf("SELECT COUNT(`rut`) as total FROM `tbl_clientes` WHERE `rut` = '%s'  ", $rutcliente);
//        $re_sql = mysqli_query($conec6, $q_query) or die("Error Fx32 =>" . $q_query . " <= ".mysqli_errno($conec6)   );
//        $row = mysqli_fetch_row($re_sql);
//        return $row[0];
//        mysqli_free_result($re_sql);
//        mysqli_close($conec6);
//    }
//}
//
//// Contar cuantas ov existen en un lote de proceso:
//
//if (!function_exists("fn_contarOVxLotes")) {
//    function fn_contarOVxLotes($idLote)
//    {
//        include('conec5.php');
//        $q_query = sprintf("SELECT count(`ordenVenta`) as total FROM `tbl_oventas` WHERE `loteProceso` = %d   ", $idLote);
//        $re_sql = mysqli_query($conec6, $q_query) or die("Error Fx31 =>" . $q_query . " <= ".mysqli_errno($conec6)   );
//        $row = mysqli_fetch_row($re_sql);
//        return $row[0];
//        mysqli_free_result($re_sql);
//        mysqli_close($conec6);
//    }
//}
//
////saber si un codigo Picking existe en la tabla tbl-picking
//if (!function_exists("fn_ordendeCompra")) {
//    function fn_ordendeCompra($ordenVenta)
//    {
//        include('conec5.php');
//        $q_query = sprintf("SELECT `ordendeCompra` FROM `tbl_oventastxt` WHERE `ordenVenta` LIKE '%s'  ", $ordenVenta);
//        $re_sql = mysqli_query($conec6, $q_query) or die("Error Fx30 =>" . $q_query . " <= ".mysqli_errno($conec6)   );
//        $row = mysqli_fetch_row($re_sql);
//        return $row[0];
//        mysqli_free_result($re_sql);
//        mysqli_close($conec6);
//    }
//}
//
//

//
//
//

//
//
//
////Genera Una clave aleatoria para usuarios que desean cambiar la suya
//if (!function_exists("generaPass")) {
//    function generaPass()
//    {
//
//        //Se define una cadena de caractares. Te recomiendo que uses esta.
//        $cadena = "abcdefghijklmnopqrstuvwxyz1234567890";
//        //Obtenemos la longitud de la cadena de caracteres
//        $longitudCadena = strlen($cadena);
//
//        //Se define la variable que va a contener la contraseña
//        $pass = "";
//        //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
//        $longitudPass = 12;
//
//        //Creamos la contraseña
//        for ($i = 1; $i <= $longitudPass; $i++) {
//            //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
//            $pos = rand(5, $longitudCadena - 1);
//
//            //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
//            $pass .= substr($cadena, $pos, 1);
//        }
//        return $pass;
//    }
//}
//
//
//

//
//// Nombre CLiente sucursal
//// El rut del cliente viene con puntos y lo tenemos registrados sin el./
////hay que limpiar los puntos antes de leer en la base de datos
//if (!function_exists("fn_nombreClienteSucursal")) {
//    function fn_nombreClienteSucursal($var1)
//    {
//        include('conec5.php');
//
//        $patron = ".";    //<---- asi
//        $cadena_nueva = str_replace($patron, "", $var1);
//        //  return $cadena_nueva;
//
//        $q_query = sprintf("SELECT `nombreSucursal` FROM `tblz_clientesSucursales` WHERE `rutSucursal` LIKE '%s' ", $cadena_nueva);
//        $re_sql = mysqli_query($conec6, $q_query) or die(mysqli_errno($conec6) . "Error Fx22 " . $q_query);
//        $row = mysqli_fetch_row($re_sql);
//        if (isset($row[0])) {
//            $retorno = $row[0];
//            return $retorno;
//        } else {
//            return "Sin Datos";
//        }
//        mysqli_free_result($re_sql);
//        mysqli_close($conec6);
//    }
//}
//
//
//// ===============================================================================================================

//
//
////Calcula la cantidad de productos que están por vencer en un perido dado
//if (!function_exists("fn_nombreEmpresa")) {
//    function fn_nombreEmpresa($idEmpresa)
//    {
//        include('conec5.php');
//        $q_rsurl = sprintf("SELECT `razonSocial`  FROM `tbl_empresa` WHERE `idEmpresa` = %d and `activo` = 'Y' limit 1 ", $idEmpresa);
//
////		return $totalresultado;
//        if ($r_rsdun = mysqli_query($conec6, $q_rsurl)) {
//            $row = mysqli_fetch_row($r_rsdun);
//            $razonSocial = $row[0];
//            return $razonSocial;
//            mysqli_free_result($r_rsdun);
//        } else {
//            return $q_rsdun;
//        }
//        mysqli_free_result($re_rsurl);
//        mysqli_close($conec6);
//    }
//}
//
//
//if (!function_exists("fn_redondear_dos_decimal")) {
//    function fn_redondear_dos_decimal($valor)
//    {
//        $float_redondeado = round($valor * 100) / 100;
//        return $float_redondeado;
//    }
//}
//
//
//////Saber si el usuario tiene privilegios, si existe es porque e suna página con privilegios
///// //la segunda consulta es para saber si el perfil tiene o no acceso.
//if (!function_exists("fn_urlPrivilegios")) {
//    function fn_urlPrivilegios($url, $idPerfil)
//    {
//        require('conec3.php');
//        $query_sql1 = sprintf("SELECT count(`idPerfil`) as total FROM `tbl-urlPrivilegios` WHERE `URL` = %s", GetSQLValueString($url, "text"));
//        $rsTotalURL1 = mysqli_query($conec6, $query_sql1);
//        $row_rsTotalURL1 = mysqli_fetch_assoc($rsTotalURL1);
//        if ($row_rsTotalURL1['total'] == 0) {
//            // retorno la URL porque no tiene restricciones y dejo pasar al usuario
//            return $url;
//        } else {
//            //hago la segunda consulta
//            $query_sql2 = sprintf("SELECT count(`idPerfil`) as total2 FROM `tbl-urlPrivilegios` WHERE `URL` = %s and `idPerfil` = %d ",
//                GetSQLValueString($url, "text"),
//                GetSQLValueString($idPerfil, "int"));
//            $rsTotalURL2 = mysqli_query($conec6, $query_sql2);
//            $row_rsTotalURL2 = mysqli_fetch_assoc($rsTotalURL2);
//
//            if ($row_rsTotalURL2['total2'] > 0) {
//                // retorno la URL porque no tiene restricciones y dejo pasar al usuario
//                return $url;
//            } else {
//                return "00-sinPrivilegios.php";
//            }
//        };
//
//        mysqli_close($conec6);
//    }
//
//    ;
//};
//
//
////Calcula la cantidad de productos que están por vencer en un perido dado
//if (!function_exists("fn_urlGuiaDespacho")) {
//    function fn_urlGuiaDespacho($idPicking)
//    {
//        include('conec5.php');
//        $q_rsurl = sprintf("SELECT `nroGuia`, `urlDocumento` FROM `tbl_clientesGuias` WHERE `idPicking` = %d and `activo` = 'Y' ", $idPicking);
//        $re_rsurl = mysqli_query($conec6, $q_rsurl) or die(mysqli_errno($conec6) . "Error en consulta");
//        $totalresultado = mysqli_num_rows($re_rsurl);
//
////		return $totalresultado;
//        if ($totalresultado > 0) {
//            $row_rsurl = mysqli_fetch_assoc($re_rsurl);
//            $varreturn = '';
//            do {
//                $varreturn = $varreturn . $row_rsurl['nroGuia'] . " <a href='docClientes/" . $row_rsurl['urlDocumento'] . "'
// 						target='_blank' data-placement='top' data-toggle='tooltip' data-original-title='Abrir Guia' >
//<i class='far fa-file-pdf fa-2x'></i> </a>   <br> ";
//            } while ($row_rsurl = mysqli_fetch_assoc($re_rsurl));
//            return $varreturn;
//        }
//        else {
//            return 0;
//        }
//        mysqli_free_result($re_rsurl);
//        mysqli_close($conec6);
//    }
//}
//
//
//
//
//
//
////Nombre Región
//
//if (!function_exists("fn_nombreRegion")) {
//    function fn_nombreRegion($idRegion)
//    {
//        switch ($idRegion) {
//            case 1:
//                $varregion = "I de Tarapacá";
//                break;
//            case 2:
//                $varregion = "II de Antofagasta";
//                break;
//            case 3:
//                $varregion = "III de Atacama";
//                break;
//            case 4:
//                $varregion = "IV de Coquimbo";
//                break;
//            case 5:
//                $varregion = "V de Valparaíso";
//                break;
//            case 6:
//                $varregion = "VI del Libertador General Bernardo O'Higgins";
//                break;
//            case 7:
//                $varregion = "VII del Maule";
//                break;
//            case 8:
//                $varregion = "VIII de Concepción";
//                break;
//            case 9:
//                $varregion = "IX de la Araucanía";
//                break;
//            case 10:
//                $varregion = "X de Los Lagos";
//                break;
//            case 11:
//                $varregion = "XI de Aysén del General Carlos Ibañez del Campo";
//                break;
//            case 12:
//                $varregion = "XII de Magallanes y de la Antártica Chilena";
//                break;
//            case 13:
//                $varregion = "Metropolitana de Santiago";
//                break;
//            case 14:
//                $varregion = "XIV de Los Ríos";
//                break;
//            case 15:
//                $varregion = "XV de Arica y Parinacota";
//                break;
//            case 16:
//                $varregion = "XVI del Ñuble";
//                break;
//        }
//        return $varregion;
//    }
//}
//
//
//

//;
//
//
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// =======Funciones para todos los sistemas=======================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
//// ===============================================================================================================
////FuncionSaber si existe un archivo
//
//

//
//
//// ===============================================================================================================
////100 Rodrigo Jaque Escobar 01 mayo 2018
////Calcula la diferencia de dias pero contando los dias domingos y sábados
//if (!function_exists("fn_timeAgo3")) {
//    function fn_timeAgo3($inicio, $fin)
//    {
//        $inicio = strtotime($inicio);
//        $fin = strtotime($fin);
//        $dif = $fin - $inicio;
//        $diasFalt = ((($dif / 60) / 60) / 24);
//        return ceil($diasFalt);
//    }
//};
//
//
//// ===============================================================================================================
////100 Rodrigo Jaque Escobar 01 mayo 2018
////Calcula la diferencia de dias pero contando los dias domingos y sábados
//if (!function_exists("fn_diferenciaenhoras")) {
//    function fn_diferenciaenhoras($inicio, $fin)
//    {
//
//        $inicio = strtotime($inicio);
//        $fin = strtotime($fin);
//        $dif = $fin - $inicio;
//        $diasFalt = ((($dif / 60) / 60));
//        return ceil($diasFalt);
//    }
//};
//
//
//// ===========================================================================================================================================================================================================================
