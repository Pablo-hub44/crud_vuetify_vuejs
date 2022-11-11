
<?php

include 'conexion.php';//llamar al archivo conexion
$objeto  = new Conexion();//instancia de nuestra conexion
$conexion = $objeto->Conectar();

//necesario para recibir parametros con Axios
$_POST = json_decode(file_get_contents("php://input"),true);

//recibir los datos enviados mediante el metodo POST desde el js
$marca = (isset($_POST['marca'])) ? $_POST['marca'] : '';
$modelo = (isset($_POST['modelo'])) ? $_POST['modelo'] : '';
$stock = (isset($_POST['stock'])) ? $_POST['stock'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1://insertar nuevo
        $consulta = "INSERT INTO moviles (marca, modelo, stock) VALUES ('$marca', '$modelo', '$stock')";// el id no pk es autoincremental
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();

        $consulta = "SELECT * FROM moviles ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2://modificar
        $consulta = "UPDATE moviles SET marca='$marca', modelo='$modelo', stock='$stock' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM moviles WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;      
    case 3://eliminar
        $consulta = "DELETE FROM moviles WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;  
    case 4://mostrar
        $consulta = "SELECT * FROM moviles";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;

}

echo json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=NULL;

