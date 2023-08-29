<?php

class C_MYSQL_RKM
{
    private $host = 'localhost';
    private $db = 'siniestros';
    private $usuario = 'rodrigo';
    private $clave = 'chinito';

    //private $host = "localhost";
    //private $db = "chy81757_siniestros";
    //private $usuario = "chy81757_ivan";
    //private $clave = "OQ_l&HIxs6Po";

    public $conexion;

    public function __construct()
    {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->clave, $this->db) or die(mysqli_error() . "Error Conexión");
        $this->conexion->set_charset("utf8");
    }


    //BUSCAR
/* Como se usa
 //$user = new C_MYSQL_RKM();
   $tablaBD = "`tbl_contenedor_estado`";
    $condicion = sprintf("`activo` = 1", );
    $ordenax =  "`id_estado_contenedor`";
    $asc_desc =  "ASC";
    $limite = 200;
    if($resultado=$user->buscar($tablaBD,$condicion))
    foreach ($resultado as $value)
    echo $value['id_chofer']."-".$value['nombre_chofer']."<br>";
    else
    echo  "No hay registros";
*/

    public function  buscar($tabla, $condicion, $ordenax, $asc_desc, $limite)
    {
        $query = "SELECT * FROM $tabla WHERE $condicion  ORDER BY $ordenax $asc_desc limit  $limite";
        $resultado = $this->conexion->query( $query) or die($this->conexion->error);
        if ($resultado) {
           return $resultado->fetch_all(MYSQLI_ASSOC);
        }
        return $query;
    mysqli_free_result($resultado);
    }



    //INSERTAR
    /*Como se usa Insertar
       $user = new C_MYSQL_RKM();
       $u=$user->insertar("tbl_chofer","7, '1-9', 'Gerardo', '55555', 'prueba@prueba.cl', '54321', Now(), Now(), 1");
       if($u)
           echo "Insertado";
       else
           echo "No insertado";
    mysqli_free_result($u);
       */
    public function insertar($tabla, $datos)
    {
        $query = "INSERT INTO $tabla VALUES (null,$datos)";
        $resultado = $this->conexion->query($query) or die($this->conexion->error."/".$query);
        if ($resultado) {
            return true;
        }

        return false;
    }


    //ACTUALIZAR
    /* Como se usa
 $userUpdate = new ApptivaDB();
        $tablaBD = "`tbl_s_usuarios`";
        $campo = sprintf("`clave_s_usuario`= '%s'",   $email );
        $condicion = sprintf("`id_s_usuario`='%s'",   $id_s_usuario );
        $u=$userUpdate->actualizar($tablaBD,$campo,$condicion);
            if($u)
                echo "Actualizado";
            else
                echo "No actualizado"; */

    public function actualizar($tabla, $campos, $condicion)
    {
        $query = "UPDATE $tabla SET $campos WHERE $condicion";
        $resultado = $this->conexion->query($query) or die($this->conexion->error."Error $query");
        if ($resultado) {
            return true;
        }

        return $query;
    }


    //BORRAR
    /* Como se usa
    $user = new C_MYSQL_RKM();
     $u=$user->borrar("tbl_chofer","id_chofer=46");
    if($u)
    echo "Borrado";
    else
    echo "No borrado";
       mysqli_free_result($u);
    */
    public function borrar($tabla, $condicion)
    {
        $query = "DELETE FROM $tabla WHERE $condicion";
        $resultado = $this->conexion->query($query) or die($this->conexion->error);
        if ($resultado) {
            return true;
        }

        return false;
    }
}
