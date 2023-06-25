var appSMessa = angular.module("service.mensajes",[])
.factory('Mensajes',['$http','$q',($http, $q) => {
    var self= {
        mensajes: {},
        cargar : () => {
            var q = $q.defer();
            $http.get('../server/datafake/mensajes.json')
            .then(response => {
                self.mensajes = response.data.mensajes
                q.resolve()
            })
            .catch(reject => {
                q.reject()
            })
            return q.promise
        }
    }   
    return self;
}])