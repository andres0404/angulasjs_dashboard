<?php 
require_once("class.database.php");
header('Content-Type: application/json;');


$respuesta = json_encode( Database::get_arreglo("SELECT pais from clientes group by pais order by pais"));

print_r($respuesta);