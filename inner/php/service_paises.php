<?php 
require_once(__DIR__."/../../vendor/autoload.php");
header('Content-Type: application/json;');

use DatabaseAccess\Database;
use DatabaseAccess\Key;


class Paises {

    private static $_obj = null;

    public static function getInstace():Paises {
        if(self::$_obj === null) {
            self::$_obj = new self();
        }
        return self::$_obj;
    }

    public function getPaises(){
        try{
            Key::JwtValidacion();
            $respuesta = json_encode( Database::get_arreglo("SELECT pais from clientes group by pais order by pais"));
            print_r($respuesta);
        } catch ( UnexpectedValueException $e){
            echo $e->getMessage();
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}
Paises::getInstace()->getPaises();
