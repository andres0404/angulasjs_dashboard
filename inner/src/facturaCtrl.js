// // const { default: Swal } = require("sweetalert2");

var facturaCtrl = angular.module('controller.factura',[
    'service.factura',
    // 'service.clientes'
]);
facturaCtrl.controller('facturaCtrl',['$scope','Factura','Clientes', function ($scope, Factura, Clientes) {
    console.log("Factura Controlador");
    $scope.cliente = {}
    $scope.buscar = "";
    $scope.agregar = {
        producto_id: "",
        cantidad: 0
    }
    $scope.factura = "";
    // $scope.factura.ISV = $scope.config.ISV
    $scope.hoy = new Date();

    $scope.buscarCliente = (cosa) => {
        $scope.clientes = {}
        Clientes.buscar(cosa).then (() => {
            $scope.cliente = {};
            if(isNaN(cosa)){
                $("#modal_buscar_cliente").modal();
                $scope.clientes = Clientes.clientes;
            } else {
                $scope.cliente = Clientes.clientes[0]
            }
        })
    }
    $scope.cliente_sel = (cliente) => {
        console.log("cliente seleccionado",cliente)
        $("#modal_buscar_cliente").modal('hide');
        $scope.cliente = cliente
    }
    $scope.actualizar = () => {
        Factura.recalcular();
    }
    $scope.buscar_producto = (producto) => {
        if(producto.producto_id == "") {
            return ;
        }
        Factura.buscar_producto(producto.producto_id)
        .then(prod => {
            Factura.agregar_detalle(prod);
            $scope.agregar.producto_id = "";
            $scope.agregar.cantidad = 1
        })
    }
    $scope.guardar_factura = () => {
        Factura.cliente_id = $scope.cliente.cliente_id;
        Factura.guardar_factura()
    }

    $scope.borrar_detalle = (item) => {
        Factura.borrar_detalle(item);
    }
    $scope.cancelar_orden = () => {
        Swal({
            
        },(isConfirm) => {
            if(isConfirm){
                $scope.cliente = {};
                Factura.nueva_factura();
                $scope.$apply()
            }
        })
    }
}])