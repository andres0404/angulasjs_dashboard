<?php
require_once(__DIR__ . "/../../vendor/autoload.php");


use DatabaseAccess\Database;
use DatabaseAccess\Key;

header('Content-Type: application/json;');
try {
    Key::JwtValidacion();
    $_POST = json_decode(file_get_contents("php://input"), true);
    
    // print_r($_POST);
    $sql = "INSERT INTO `clientes` (`nombre`, `correo`, `zip`, `telefono1`, `telefono2`, `pais`, `direccion`)
VALUES ('{$_POST['nombre']}', '{$_POST['correo']}', '{$_POST['zip']}', '{$_POST['telefono1']}', '{$_POST['telefono2']}', '{$_POST['pais']}', '{$_POST['direccion']}');";
    if (isset($_POST['id'])) {
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

    $respuesta = ['err' => false, 'mensaje' => 'Registro almacenado', "sql" => $sql];
    $code = Database::ejecutar_idu($sql);
    if ($code !== true) {
        $respuesta = ['err' => true, 'mensaje' => $code, "sql" => $sql];
    }

    echo json_encode($respuesta);
} catch (UnexpectedValueException $e) {
    echo $e->getMessage();
} catch(Exception $e) {
    echo $e->getMessage();
}