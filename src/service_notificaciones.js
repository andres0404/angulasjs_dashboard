var appNotificacion = angular.module('service.notificaciones',[])
.factory('Notificaciones',['$http','$q',($http, $q  ) => {
    var self = {
        notificaciones:[],
        cargar: () => {
            var q = $q.defer();
            $http.get('../server/datafake/notificaciones.json')
            .then(response => {
                self.notificaciones = response.data.notificaciones
                q.resolve()
            })
            .catch(reject => {
                q.reject()
            })
            return q.promise
        }
    }
    return self
}])