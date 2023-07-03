<?php 
require_once(__DIR__."/../../vendor/autoload.php");
header('Content-Type: application/json;');

use DatabaseAccess\Database;
use DatabaseAccess\Key;
class Clientes {
    private static $_obj = null;

    public static function getInstance() : Clientes{
        if(self::$_obj == null)
            self::$_obj = new self();
        return self::$_obj;
    }

    public static function getListClientes(){

        try {
            Key::JwtValidacion();
            $pag = $_GET['pag'] ?? 1;
            $respuesta = json_encode( Database::get_todo_paginado("clientes",$pag));
            print_r($respuesta);
        } catch (UnexpectedValueException $e) {
            echo $e->getMessage();
        } catch(Exception $e) {
            echo $e->getMessage();
        }

    }
}

Clientes::getInstance()->getListClientes();