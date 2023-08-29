<?php
if (session_id() == '') {
    session_start();
}
ini_set('memory_limit', '1400M');
ini_set('max_execution_time', 1);
ini_set('MAX_EXECUTION_TIME', -1);

/* * APPLICATION ENVIRONMENT
---------------------------------------------------------------/*/
if (!defined('ENVIRONMENT')) {
    define('ENVIRONMENT', 'local');
}

//if (!defined('ENVIRONMENT')) {
//    define('ENVIRONMENT', 'produccion');
//}

if(isset($_SERVER['HTTP_REFERER'])) {
    $MM_redirectLoginSuccess = $_SERVER['HTTP_REFERER'];
}

/*   ERROR REPORTING
---------------------------------------------------------------/*/
if (defined('ENVIRONMENT')) {
    switch (ENVIRONMENT) {
        case 'local':

            error_reporting(1);
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
            $hostname_conec = "localhost";
            $database_conec = "chy81757_siniestros";
            $username_conec = "chy81757_ivan";
            $password_conec = "OQ_l&HIxs6Po";
            break;

        case 'produccion':
            error_reporting(E_ERROR | E_WARNING | E_PARSE);
            error_reporting(0);
            ini_set('display_errors', 'Off');
            $hostname_conec = "localhost";
            $database_conec = "chy81757_siniestros";
            $username_conec = "chy81757_ivan";
            $password_conec = "OQ_l&HIxs6Po";
            break;

        default:
            exit('El entorno de la aplicación no está configurado correctamente .');
    }
}

$conec6 = mysqli_connect($hostname_conec, $username_conec, $password_conec, $database_conec);
$mysqli6 = new mysqli($hostname_conec, $username_conec, $password_conec, $database_conec);
if (!$conec6) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuracion: " . mysqli_connect_errno() . PHP_EOL;
    exit;
}

if (!$conec6->set_charset("utf8")) {//asignamos la codificación comprobando que no falle
    die("Error cargando el conjunto de caracteres utf8");
}
//seleccionamos la base de datos
mysqli_select_db($conec6, $database_conec);

//Declaración de variables
//Declaracion de variables
