var appClientes = angular.module('controller.clientes',[
    'service.clientes',
    'service.paises'
])
appClientes.controller('clientesCtrl',['$scope','$routeParams','Clientes','Paises', function($scope,$routeParams, Clientes,Paises){
    $scope.activar("mClientes","","Cliente","Información")
    $scope.clientes = {}
    Paises.cargar().then(() => {
        $scope.paises = Paises.paises
        
    })
    $scope.moverP = ( pag ) => {
        Clientes.cargarPagina(pag).then(() => {
        
            $scope.clientes = Clientes
        })
    }
    $scope.moverP($routeParams.pag);
    $scope.mostrarModal = (cliente = {}) => {
        
        $scope.cliente = cliente
        $('#modalCliente').modal()
    }
    $scope.guardar = (cli) => {
        Clientes.guardar(cli)
    }
}])