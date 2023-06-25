<?php 
require_once("class.database.php");
header('Content-Type: application/json;');

$pag = $_GET['pag'] ?? 1;

$respuesta = json_encode( Database::get_todo_paginado("clientes",$pag));

print_r($respuesta);