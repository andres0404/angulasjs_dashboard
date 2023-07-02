var appServLogin = angular.module('login.loginService',[])
.factory('LoginService',['$http','$q', function ($http, $q){
    var self = {
        ingresar: (datos) => {
            var q = $q.defer();
            $http.post('http://localhost:8080/inner/php/service_login.php', datos)
            .then(response => {
                console.log("respuesta",response)
                if(response.data.code == 1){
                    q.resolve(response.data.data)
                } else {
                    q.reject(response.data.mensaje)

                }
            })
            return q.promise;
        }
    }
    return self;
}])