<?php
require_once(__DIR__."/../../vendor/autoload.php");


use Facturacion\FacturaInterface;
use Facturacion\Factura;
use DatabaseAccess\Key;
header('Content-Type: application/json;');

class ObtenerFactura implements FacturaInterface {
    private static $_obj = null;
    private $_id ;

    public static function getInstance()  {
        if(self::$_obj === null){
            self::$_obj = new self();
        }
        return self::$_obj;
    }

    public function buscar() {
        try{
            Key::JwtValidacion();
            // $data = json_decode(file_get_contents('php://input'),true);
            $this->setItems($_GET);
            $objFactura = new Factura($this);
            $regs = $objFactura->run();
            $response = [];
            if(is_array($regs) && count($regs) > 0){
                $response = [
                    "numero_factura" => $regs[0]["numero_factura"],
                    "fecha_solicitado" => $regs[0]["fecha_solicitado"],
                    "monto" => $regs[0]["monto"],
                    "impuesto" => $regs[0]["impuesto"],
                    "monto_neto" => $regs[0]["monto_neto"],
                    "estado" => $regs[0]["estado"],
                    "comentario" => $regs[0]["comentario"],
                    "cliente_id" => $regs[0]["cliente_id"],
                    "detalles" => []
                ];
                foreach($regs as $data){
                    $response["detalles"][] = [
                        "producto_id" => $data["producto_id"],
                        "cantidad" => $data["cantidad"],
                        "precio_unitario" => $data["precio_unitario"]
                    ];
                }
            }
            echo json_encode($response);
        } catch (\Exception $e){
            echo json_encode(["code" => 400, "msg" => $e->getMessage()]);
        }
    }

    public function setItems($array){
        $this->_id = $array["id"];
    }
    public function getTransaccion(){
        return 'buscar';
    }
    public function getSql() : string{
        $sql = "SELECT * from facturas as f
        inner join 
        facturas_detalle as fd
        on f.numero_factura = fd.numero_factura
        where f.numero_factura = {$this->_id}";
        return $sql;
    }


}
ObtenerFactura::getInstance()->buscar();