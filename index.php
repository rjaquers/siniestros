<?php
$perfil_autorizado = "1";
// Si la pagina no es la correcta aquí lo va a lanzar a donde corresponda
require_once('inc_session.php');

// Sino lo mandamos a la página de home_admin
//np= nombre página
$destino =  "home_admin.php?";
$destino.=  "template=t_panel_control&";
$destino.=  "accion=listar&";
$destino.=  "titulo_pagina=Home Sistema Siniestros&";
$destino.=  "seccion=Administraci&oacute;n&";
$destino.=  "desc_pagina=Panel de control";

header("Location: ".$destino);
?>
<a href="exit.php"> salir</a>


