var log = angular.module('loginApp',[
    'login.loginService'
])
.controller('mainCtrl', ['$scope', 'LoginService',function ($scope, LoginService){
    $scope.invalido = false;
    $scope.cargando = false;
    $scope.mensaje = "";
    $scope.datos = {}
    $scope.usuario = {}
    $scope.ingresar = (datos) => {
        if(datos.usuario.length < 7) {
            $scope.invalido = true;
            $scope.mensaje = "Usuario imposible"
            return ;
        } else if(datos.password.length < 4) {
            $scope.invalido = true;
            $scope.mensaje = "Contraseña imposible"
            return ;
        }
        LoginService.ingresar(datos)
        .then(response => {
            $scope.invalido = false;
            $scope.mensaje = "";
            $scope.usuario = response
            console.log("entra", $scope.usuario)
        })
        .catch(error => {
            console.log("no entra")
            $scope.invalido = true;
            $scope.mensaje = error
        });
    }
}])