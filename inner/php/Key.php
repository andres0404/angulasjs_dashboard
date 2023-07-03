<?php


namespace DatabaseAccess;
use Firebase\JWT\JWT;
use Firebase\JWT\Key as FKey;



class Key {

    private static $_key = 'hiG8DlOKvtih6AxlZn5XKImZ06yu8I3mkOzaJrEuW8yAv8Jnkw330uMt8AEqQ5LB';
    private static $_algorithm = 'HS256';
    // private static $_key = 'PeRson3EREDFOOPP45lfodDF';


    public static function getJwt($data){
        
        $payload = self::_getPayload($data);
        return JWT::encode($payload, self::$_key, self::$_algorithm);
    }
    
    
    private static function _getPayload($data, $iat = null,$exp = null){
        $time = time();
        $arrData = [];
        if(gettype($data) == "object"){
            foreach ($data as $key => $value) {
                $arrData[$key] = $value;
            }
        } else {
            $arrData = $data;
        }
        return [
            'iat' => $iat ?? $time,// timepo de inicio token
            'exp' => $exp ?? ($time + (60*60)), // tiempo expiracion del token (60*60) => 1 hora
            "data" => $arrData
        ];
    }
    
    
    public static function JwtValidacion(){
        $allHeaders = getallheaders();
        if(!isset($allHeaders['Authorization'])){
            throw new \Exception("Acceso denegado");
        }
        $decoded = JWT::decode($allHeaders['Authorization'], new FKey(self::$_key, self::$_algorithm));
        $token = JWT::encode(self::_getPayload($decoded->data,$decoded->iat,$decoded->exp), self::$_key, self::$_algorithm);
    }
}

