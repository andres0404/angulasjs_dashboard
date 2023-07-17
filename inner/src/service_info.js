var appSInfo = angular.module('service.info', [])
.factory('Configuracion',['$http','$q',($http, $q) => {
    var self = {
        info:{},
        cargar: () => {
            var q = $q.defer();
            $http.get('../package.json')
            .then(response => {
                q.resolve()
                self.info = response.data
            })
            .catch(reject => {
                q.reject()
            })
            return q.promise;
        }
    }
    return self;
}])