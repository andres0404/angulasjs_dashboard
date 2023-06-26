var appClientes = angular.module('controller.clientes',[
    'service.clientes',
    'service.paises'
])
appClientes.controller('clientesCtrl',['$scope','$routeParams','Clientes','Paises', function($scope,$routeParams, Clientes,Paises){
    $scope.activar("mClientes","","Cliente","Información")
    $scope.clientes = {}
    $scope.error = false
    $scope.success = false;
    $scope.error_message = ''
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
        $scope.error = false
        $scope.success = false;
        $('#modalCliente').modal()
    }
    $scope.guardar = (cli) => {
        $scope.error = false
        $scope.success = false
        $scope.error_message = ''
        Clientes.guardar(cli)
        .then(r => {
            $scope.success = true
            $scope.error_message = 'Registro actualizado correctamente'
            setTimeout(() => {
                $scope.success = false
                $('#modalCliente').modal('hide')

            },3000)
        })
        .catch(error => {
            $scope.error = true;
            $scope.error_message = error
        })
    }
}])