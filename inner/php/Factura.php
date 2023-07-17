<?php


namespace Facturacion;

use DatabaseAccess\Database;
use DatabaseAccess\Key;
use Facturacion\FacturaInterface;

class Factura  {    
    private FacturaInterface $_objFactura;
    public function __construct(
        FacturaInterface $objFactura
    ){
        $this->_objFactura = $objFactura;
    }

    public function run(){
        switch($this->_objFactura->getTransaccion()) {
            case 'buscar':
                return $this->buscar();
                break;
            case 'guardar':
                $this->guardar();
                break;
        }
    }


    private function buscar() {
        return Database::get_arreglo($this->_objFactura->getSql());
    }
    private function guardar(){
        $id_factura = Database::ejecutar_idu($this->_objFactura->getSql());
        if(!is_numeric($id_factura)){
            throw new \Exception("Error {$id_factura}");
        }
        Database::ejecutar_idu($this->_objFactura->getSqlDetalles($id_factura));
    }
}