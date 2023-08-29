<?php
include "qrlib.php";
   if (isset($_GET['patente'])) {
           $patente = trim(filter_input(INPUT_GET, 'patente', FILTER_SANITIZE_STRING));
       }
$patente = $patente;
$url = "https://www.hyv.cl/siniestros/fotos_siniestro.php?patente=$patente";
QRcode::png($url, 'patente.png', 'H', 8, 2);
QRcode::png($url);
//show benchmark
QRtools::timeBenchmark();
//rebuild cache
QRtools::buildCache();

header("Location: patente_imprimir.php?patente=". $patente);


