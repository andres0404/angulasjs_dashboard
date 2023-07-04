var appPaises = angular.module('service.paises',[
    'config.conf'
])
.factory('Paises',['$http','$q','URL',($http, $q, URL) => {
    var self = {
        paises:[],
        cargar: () => {
            var q = $q.defer()
            $http.get(`${URL}service_paises.php`,{headers:{'Authorization': localStorage.getItem("apptoken")}})
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