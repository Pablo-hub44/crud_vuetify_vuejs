<?php

/*try{ otra forma de conexion
    $conexion= new mysqli("localhost", "root", "", "los_usuarioscrud");
}catch(Exception $e){
    echo $e->getMessage();
    exit;
}*/



/* ping para saber si , si esta conectada la bd
if ($conexion->ping()) {
    echo 'todo bien';
}else{
    echo $conexion->connect_error;
}
*/


class Conexion{
    public static function Conectar(){
        define('servidor', 'localhost');
        define('nombre_db', 'vuetify_bd');
        define('usuario', 'root');
        define('password', '');

        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND  => 'SET NAMES utf8');

        try {
            $conexion = new PDO ("mysql:host=".servidor."; dbname=".nombre_db, usuario, password, $opciones);
            //echo "Conexion Exitosa <br>";
            return $conexion;
        } catch (Exception $e) {
            die("El error de conexion es:". $e->getMessage());
        }
    }
}




?>