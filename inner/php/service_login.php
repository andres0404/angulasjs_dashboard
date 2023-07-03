<?php

require_once(__DIR__."/../../vendor/autoload.php");

use DatabaseAccess\Database;
use DatabaseAccess\Key;

// require_once("class.database.php");
header('Content-Type: application/json;');


class Login {
    
    private static $_obj;
    
    public function Login(){}
    
    public static function getInstace() {
        if(empty(self::$_obj)) {
            self::$_obj = new self();
        }
        return self::$_obj;
    }
    
    public function loguear(){
        $_data = json_decode(file_get_contents("php://input"),true);
        $sql = "SELECT id,codigo,nombre,ultimoacceso FROM usuarios WHERE codigo = '". addslashes( $_data['usuario'])."' AND contrasena = sha1('". addslashes($_data['password']) ."') ";
        $result = Database::get_row($sql);
        $response = [
            "mensaje" => "Usuario o contraseña invalido" ,
            "code" => 0 
        ];
        if(count($result) > 0){
            $response = [
                "mensaje" => "" ,
                "code" => 1 ,
                "data" => $result,
                "token" => Key::getJwt($result)
            ];
        }
        echo json_encode($response);
    }
}
Login::getInstace()->loguear();


