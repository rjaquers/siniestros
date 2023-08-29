<?php
if (isset($_POST['id_formulario']) and ($_POST['id_formulario'] == "107")) {
    require_once('../c_connections/conec6.php');
    require_once('../c_connections/funciones.php');

    //Defino las carpetas de las fotos
    // Siempre existirá nro de patente, pero puede que no exista id siniestro, entonces coloco la fecha
    if (isset($_POST['id_patente'])) {
        $id_patente = trim(filter_input(INPUT_POST, 'id_patente', FILTER_SANITIZE_NUMBER_INT));
        $carpeta_patente = $id_patente;
    }

    if (isset($_POST['patente'])) {
        $patente = trim(filter_input(INPUT_POST, 'patente', FILTER_SANITIZE_STRING));

    }
    if (isset($_POST['id_siniestro'])) {
        $id_siniestro = trim(filter_input(INPUT_POST, 'id_siniestro', FILTER_SANITIZE_NUMBER_INT));
        $carpeta_siniestro =  $id_siniestro;
    } else {
        $carpeta_siniestro = date("Y_m_d_H_i");
    }
    if (isset($_POST['id_usuario'])) {
        $id_usuario = trim(filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_NUMBER_INT));
    }

        //Declaramos los directorios
        $directorio_originales = "../img/fotos/".$carpeta_patente."/".$carpeta_siniestro."/originales/";
        $directorio_chicas = "../img/fotos/".$carpeta_patente."/".$carpeta_siniestro."/chicas/";


        //Creamos los directorios
        if (!file_exists($directorio_originales)) {
            mkdir($directorio_originales,  0777, true) or die("No se puede crear el directorio de extracci&oacute;n | $directorio_originales");
        }


        if (!file_exists($directorio_chicas)) {
            mkdir($directorio_chicas, 0777, true) or die("No se puede crear el directorio de extracci&oacute;n |$directorio_chicas");
        }

        //

        //Como el elemento es un arreglos utilizamos foreach para extraer todos los valores
        foreach ($_FILES["file"]["tmp_name"] as $key => $tmp_name)
        {
            //Validamos que el file exista, //Validamos si la ruta de destino existe, en caso de no existir la creamos
            if ($_FILES["file"]["name"][$key]) {
                $filename = $_FILES["file"]["name"][$key]; //Obtenemos el nombre original del file
                $source = $_FILES["file"]["tmp_name"][$key]; //Obtenemos un nombre temporal del file
                $extension = $_FILES["file"]["type"][$key];
                $tamaño = $_FILES["file"]["tmp_name"][$key]; // Obtenemos el tamaño del archivo
                if($tamaño)

                //Reconocer la extensión del archivo
                switch ($extension) {
                    case 'image/jpeg':
                        $extension = 'jpg';
                        break;
                    case 'image/png':
                        $extension = 'png';
                        break;
                }

                $nombre_foto = rand(1111111, 9999999);
                $hoy = date("Y_m_d");

                $nombreCodificado6 = $id_patente."_".$hoy."_".$nombre_foto.md5(time()).".".$extension;


                $dir = opendir($directorio_originales); //Abrimos el directorio de destino
                $target_path = $directorio_originales.'/'.$nombreCodificado6; //Indicamos la ruta de destino, así como el nombre del file

                //Movemos y validamos que el file se haya cargado correctamente
                 move_uploaded_file($source, $target_path);
                //El primer campo es el origen y el segundo el destino

                    //	 Incluimos la clase
                    include_once('../c_connections/rezise_class.php');
                    $resizeObjTumb = new resize($target_path); // creamos el objeto y cargamos la imagen
                    $resizeObjTumb->resizeImage(70, 52, "auto"); // Proporcianos el nuevo tamaño de la imagen
                    $resizeObjTumb->saveImage($directorio_chicas."/".$nombreCodificado6, 30);// Guardamos la imagen con una calidad del 100%


                //Registramos la foto en la base de datos
                if (mysqli_connect_errno()) {
                    printf("Falló la conexión: %s\n", mysqli_connect_error());
                    exit();
                }
                $query_sql1 = sprintf("INSERT INTO `tbl_fotos` (  `id_patente`, `id_siniestro`, `url_foto`,   `id_usuario`) VALUES ( %d, %d, '%s', %d)",
                    $id_patente,
                    $id_siniestro,
                    $nombreCodificado6,
                    $id_usuario );
                if ($result_SQL_rsAgenda = mysqli_query($conec6, $query_sql1))
                {
                    $Valor = true;
                } else { die("No se grabó el archivo en la base de datos" . $query_sql1);}


                closedir($dir); //Cerramos el directorio de destino
            } else {
                echo " Ha ocurrido un error al subir el Archivo";
                die();
            }
        }

    } else { die("Algún error"); }


$destino = "../home_admin.php?";
$destino .= "id_siniestro=$id_siniestro&";
$destino .= "id_patente=$id_patente&";
$destino .= "patente=$patente&";
$destino .= "template=t_fotos_listar&";
$destino .= "accion=ver&";
$destino .= "titulo_pagina=Ver Fotos&";
$destino .= "seccion=Administraci&oacute;n Fotos&";
$destino .= "desc_pagina=Ver Fotos Siniestros";
header(sprintf("Location: %s", $destino));