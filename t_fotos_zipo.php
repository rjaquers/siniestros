<?php

if (isset($_GET['patente'])) {
    $id_patente = trim(filter_input(INPUT_GET, 'id_patente', FILTER_SANITIZE_STRING));
    $patente = trim(filter_input(INPUT_GET, 'patente', FILTER_SANITIZE_STRING));
}
include_once("query/q_fotos_siniestro_x_id.php");

$nro_siniestro=fn_nro_siniestro($row_fotos_carr['id_siniestro']);

   $filename = "zip/fotos_patente_".$patente."_Sin_".$nro_siniestro.".zip";

$i = 1;
//do {
//    echo "img/fotos/".$row_fotos_carr['id_patente']."/".$row_fotos_carr['id_siniestro']."/grandes/".$row_fotos_carr['url_foto']." ", "/foto_".$i++.".jpg <br>";
//
//} while ($row_fotos_carr = mysqli_fetch_assoc($re_fotos_carr));


if ($totalRows_fotos_carr > 0 ) {
    //Creo el archivo zip
    $zip = new ZipArchive();
    $patente = fn_patente_x_id($row_fotos_carr['id_patente']);
    $filename = "zip/Fotos_".$patente."_".$row_fotos_carr['id_siniestro'].".zip";
    if ($zip->open($filename, ZipArchive::CREATE) !== true) {
        exit("cannot open <$filename>\n");
    }
    //busco en la base de datos el listado de archivos
    $id_patente = $row_fotos_carr['id_patente'];
    $id_siniestro = $row_fotos_carr['id_siniestro'];
    do {
        $url_foto = $row_fotos_carr['url_foto'];
        $zip->addFile("img/fotos/$id_patente/$id_siniestro/grandes/$url_foto", "foto_".$i++.".jpg");
        //$zip->addFile(  "img/fotos/1/13/grandes/1_2022_08_07_2761337f9daa995405e8021f45e8edc6c24b1f8.jpg","/foto1.jpg");
    } while ($row_fotos_carr = mysqli_fetch_assoc($re_fotos_carr));
}
echo "numero de archivos ficheros: ".$zip->numFiles."\n";
echo "estado:".$zip->status."\n";
$zip->close();


?>
<div class="row">
    <div class="col-xl-12">
        <div id="panel-1" class="panel">
            <div class="panel-hdr">
                <h2> Siniestro > Fotos: <?php echo strtoupper($_GET['patente']); ?> / <span class="fw-300"><i><?php echo $_GET['accion']; ?>  </i></span></h2>

                <div class="panel-toolbar  ">
                    <div class="pull-right">
                        <a href="home_admin.php?id_patente=<?php echo $id_patente; ?>&patente=<?php echo $patente; ?>&template=t_siniestro_crear&accion=crear&titulo_pagina=Siniestro>Crear&seccion=Siniestros&desc_pagina=Sistema de registro de nuevos Siniestros por patente">
                            <button class="btn btn-info" value="Siniestro Crear"><i class="fa fa-car-burst"></i> Registrar Nuevo Siniestro</button>
                        </a>
                    </div>
                    <?php include_once("inc_balls.inc"); ?>
                </div>

            </div>
            <div class="panel-container show">
                <div class="panel-content">

 <a href=" <?php echo $filename;?>"  >

                    <button type="button" class="btn btn-lg btn-outline-success waves-effect waves-themed">
                        <span class="fal fa-download mr-1"></span>
                        Download Archivo Zip con fotos
                    </button>
 </a>
                </div>

            </div>
        </div>
    </div>
</div>