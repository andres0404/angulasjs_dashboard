var appPaises = angular.module('service.paises',[])
.factory('Paises',['$http','$q',($http, $q) => {
    var self = {
        paises:[],
        cargar: () => {
            var q = $q.defer()
            $http.get("http://localhost:8080/php/service_paises.php")
            .then(response => {
                self.paises = response.data.map(elem => elem.pais)
                q.resolve()
            })
            .catch(error => {
                q.reject()
            });
            return q.promise
        }
    }
    return self
}])