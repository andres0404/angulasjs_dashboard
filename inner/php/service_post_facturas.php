<?php
require_once(__DIR__."/../../vendor/autoload.php");

use Facturacion\FacturaInterface;
use Facturacion\Factura;
use DatabaseAccess\Key;

header('Content-Type: application/json;');

class PostFactura implements FacturaInterface {
    private static $_obj = null;
    private $_numero_factura;
    private $_fecha_solicitado;
    private $_monto;
    private $_impuesto;
    private $_monto_neto;
    private $_estado;
    private $_comentario;
    private $_cliente_id;
    private $_detalle;

    public static function getInstance(){
        if(self::$_obj === null){
            self::$_obj = new self();
        }
        return self::$_obj;
    }

    public function setItems($array){
        $this->_monto = $array['monto'];
        $this->_impuesto = $array['impuesto'];
        $this->_monto_neto = $array['monto_neto'];
        $this->_estado = $array['estado'];
        $this->_comentario = $array['comentario'];
        $this->_cliente_id = $array['cliente_id'];
        $this->_detalle = $array['detalle'];
    }
    public function getTransaccion(){
        return 'guardar';
    }

    public function getSql() : string {
        $sql = "INSERT INTO facturas (
        fecha_solicitado,
        monto,
        impuesto,
        monto_neto,
        estado,
        comentario,
        cliente_id) VALUES (
            now(),
        '$this->_monto',
        '$this->_impuesto',
        '$this->_monto_neto',
        '$this->_estado',
        '$this->_comentario',
        '$this->_cliente_id'
        )";
        return $sql;
    }
    public function getSqlDetalles($id_factura){
        $det = [];
        for($i = 0 ; $i < count($this->_detalle); $i++) {
            $det[] = "
            '{$id_factura}',
            '{$this->_detalle[$i]['producto_id']}',
            '{$this->_detalle[$i]['cantidad']}',
            '{$this->_detalle[$i]['precio_unitario']}'
            ";
        }
        $sql = ("INSERT INTO facturas_detalle (
    numero_factura,
    producto_id,
    cantidad,
    precio_unitario) VALUES (" . implode("),(",$det).")");
        return $sql;
    }
    public function guardar() {
        try{
            Key::JwtValidacion();
            $data = json_decode(file_get_contents('php://input'),true);
            $this->setItems($data);
            $objFactura = new Factura($this);
            $objFactura->run();
            $response = [
                "code" => 200,
                "msg" => "ok"
            ];
        }
        catch(\Exception $e){   
            $response = [
                "code" => 400,
                "message" => $e->getMessage()
            ];
        }
        echo json_encode($response);
    }


}
PostFactura::getInstance()->guardar();