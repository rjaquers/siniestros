<?php
$perfil_autorizado = "2";
// Si la pagina no es la correcta aquí lo va a lanzar a donde corresponda
require_once('inc_session.php');

// Sino lo mandamos a la página de home_admin
//np= nombre página
$destino =  "home_asesor.php?";
$destino.=  "template=t_patentes_listar&";
$destino.=  "accion=listar&";
$destino.=  "titulo_pagina=Home Sistema Siniestros&";
$destino.=  "seccion=Patentes&";
$destino.=  "Perfil=Asesor&";
$destino.=  "desc_pagina=Panel de control";

header("Location: ".$destino);
?>
<a href="exit.php"> salir</a>
