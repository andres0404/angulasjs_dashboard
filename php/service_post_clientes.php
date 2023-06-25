<?php 
require_once("class.database.php");
header('Content-Type: application/json;');
$_POST = json_decode(file_get_contents("php://input"), true);
// print_r($_POST);
$sql = "INSERT INTO `clientes` (`nombre`, `correo`, `zip`, `telefono1`, `telefono2`, `pais`, `direccion`)
VALUES ('{$_POST['nombre']}', '{$_POST['correo']}', '{$_POST['zip']}', '{$_POST['telefono1']}', '{$_POST['telefono2']}', '{$_POST['pais']}', '{$_POST['direccion']}');";
if(isset($_POST['id'])){
    $sql = "UPDATE `clientes` SET
    `nombre` = '{$_POST['nombre']}',
    `correo` = '{$_POST['correo']}',
    `zip` = '{$_POST['zip']}',
    `telefono1` = '{$_POST['telefono1']}',
    `telefono2` = '{$_POST['telefono2']}',
    `pais` = '{$_POST['pais']}',
    `direccion` = '{$_POST['direccion']}'
    WHERE `id` = '{$_POST['id']}';";
}

$respuesta = ['err' => false, 'mensaje' => 'Registro almacenado' ,"sql" => $sql];
if($code = Database::ejecutar_idu($sql)) {
    $respuesta = ['err' => true, 'mensaje' => $code,"sql" => $sql];
} 

echo json_encode($respuesta);