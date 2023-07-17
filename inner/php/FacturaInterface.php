<?php

namespace Facturacion;

interface FacturaInterface {
    public function setItems($array);
    public function getTransaccion();
    public function getSql() : string;
}