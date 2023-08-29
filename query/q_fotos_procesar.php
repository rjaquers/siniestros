<?php
ini_set('max_execution_time', '600');
if (!ini_get('display_errors')) {
    ini_set('display_errors', '0');
}
if (isset($_GET['url_foto'])  ) {
    require_once('../c_connections/conec6.php');
    require_once('../c_connections/funciones.php');

    //Defino las carpetas de las fotos
    // Siempre existirá nro de patente, pero puede que no exista id siniestro, entonces coloco la fecha

    if (isset($_GET['url_foto'])) {
        $url_foto = trim(filter_input(INPUT_GET, 'url_foto', FILTER_SANITIZE_STRING));
    }

    if (isset($_GET['id_foto'])) {
        $id_foto = trim(filter_input(INPUT_GET, 'id_foto', FILTER_SANITIZE_STRING));
    }


    if (isset($_GET['patente'])) {
        $patente = trim(filter_input(INPUT_GET, 'patente', FILTER_SANITIZE_STRING));
    }

    //forma la ruta de la foto
    if (isset($_GET['id_patente'])) {
        $id_patente = trim(filter_input(INPUT_GET, 'id_patente', FILTER_SANITIZE_NUMBER_INT));
        $carpeta_patente = $id_patente;
    }
    if (isset($_GET['id_siniestro'])) {
        $id_siniestro = trim(filter_input(INPUT_GET, 'id_siniestro', FILTER_SANITIZE_NUMBER_INT));
        $carpeta_siniestro = $id_siniestro;
    }

    //Declaramos los directorios
    $directorio_originales = "../img/fotos/".$carpeta_patente."/".$carpeta_siniestro."/originales/";
    $directorio_grandes = "../img/fotos/".$carpeta_patente."/".$carpeta_siniestro."/grandes/";

    //Creamos los directorios fotos grandes
    if (! file_exists($directorio_grandes)) {
        mkdir($directorio_grandes, 0777, true) or die("No se puede crear el directorio de extracci&oacute;n | $directorio_grandes");
    }

    $dir = opendir($directorio_originales); //Abrimos el directorio de destino
    $target_path = $directorio_originales.'/'.$url_foto; //Indicamos la ruta de destino, así como el nombre del file
    //Resize grandes
    include_once('../c_connections/rezise_class.php');
    $resizeObjTumb = new resize($target_path); // creamos el objeto y cargamos la imagen
    $resizeObjTumb->resizeImage(1366, 1025, "auto"); // Proporcianos el nuevo tamaño de la imagen
    $resizeObjTumb->saveImage($directorio_grandes."/".$url_foto, 60);// Guardamos la imagen con una calidad del 60%

    closedir($dir); //Cerramos el directorio de destino
    //cierro
     $q_u_Foto_x_id = sprintf("UPDATE `tbl_fotos` SET `procesada` = '1' WHERE `tbl_fotos`.`id_foto` = %d ",  $id_foto );
     $re_XXX = mysqli_query($conec6, $q_u_Foto_x_id) or die(mysqli_error($conec6) . " - Error 43 $q_u_Foto_x_id");

    unlink( $directorio_originales."/".$url_foto);

} else {
    echo " Ha ocurrido un error al Procesar foto";
    die();
}

//echo "Proceso terminado";



$volver = "../".$_SESSION['home']."?";
$volver.= "id_siniestro=".$id_siniestro."&";
$volver.= "id_patente=".$id_patente."&";
$volver.= "patente=".$patente."&";
$volver.= "accion= Ver%20Fotos%20Siniestro&";
$volver.= "template=t_fotos_listar&";
$volver.= "titulo_pagina= Ver Fotos&";
$volver.= "seccion= Administracion&";
$volver.= "desc_pagina= Ver 20Fotos 20Siniestros";

header(sprintf("Location: %s", $volver));
