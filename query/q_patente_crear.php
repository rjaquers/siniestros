<?php
include_once("../c_connections/conec6.php");
//require_once('../c_connections/funciones.php');
//Descripción: Crea una nueva clave para el usuario del correo registrado
//Fecha: 09 julio 2022
//Solicitado por: Rodrigo Jaque
$destino = "../home_admin.php?";
$destino .= "template=t_patentes_listar&";
$destino .= "accion=listar&";
$destino .= "titulo_pagina=Patentes>Listar&";
$destino .= "seccion=Administraci&oacute;n&";
$destino .= "desc_pagina=Administración de patente";
if (isset($_POST['id_formulario']) and ($_POST['id_formulario'] == 109)) {
    //a donde lo envío si es correcto el correo
    $patente = trim(filter_input(INPUT_POST, 'patente', FILTER_SANITIZE_STRING));
    $id_usuario = trim(filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_STRING));


    $q_sql = sprintf("INSERT INTO `tbl_patentes` ( `patente`,   `id_usuario`) VALUES (  '%s',  %d);", $patente, $id_usuario );
    $re_sql = mysqli_query($conec6, $q_sql) or die("<h3>Error </h3> <p>Al parecer la patente ya estaba registrada. revise los datos
 <br>
 <a href='../home_admin.php?template=t_siniestros_listar&patente=$patente&accion=ver&&titulo_pagina=Patentes > Ver Siniestros&seccion=Administracion&desc_pagina=Ver siniestros de la patente'> Ver Patente ya registrada</a>
 <br>
 
 </p>  " .  mysqli_error($conec6)."<br style='font: small'> -  $q_sql");

    header("Location: ".$destino);


} else {
    die("No eliminado");
}