var appClientes = angular.module('service.clientes',[
    'config.conf'
])
.factory('Clientes',['$http','$q','URL',($http, $q, URL) => {
    var self = {
        cargando        : false,
        'err'     		: false, 
        conteo   		: 0,
        clientes		: [],
        'pag_actual'    : 1,
        'pag_siguiente' : 1,
        'pag_anterior'  : 1,
        'total_paginas' : 1,
        'paginas'	    : [],
        guardar: (cliente) => {
            var q = $q.defer();
            $http.post(`${URL}service_post_clientes.php`,cliente, {headers:{'Authorization':localStorage.getItem('apptoken')}})
            .then(response => {
                if(response.data.err){
                    q.reject(response.data.mensaje)
                } else {
                    q.resolve()
                    self.cargarPagina(self.pag_actual)
                }
            })
            .catch(error => {
                q.reject()
            })  
            return q.promise;
        },
        cargarPagina: (pag = 1) => {
            var q = $q.defer()
            $http.get(`${URL}service_clientes.php?pag=${pag}`,{headers:{'Authorization': localStorage.getItem('apptoken')}})
            .then(response => {
                self.conteo = response.data.conteo
                self.clientes = response.data.clientes
                self.pag_actual = response.data.pag_actual
                self.pag_siguiente = response.data.pag_siguiente
                self.pag_anterior = response.data.pag_anterior
                self.total_paginas = response.data.total_paginas
                self.paginas  = response.data.paginas
                q.resolve()
            })
            return q.promise;
        },
        buscar: (busqueda) => {
            var q = $q.defer();
            self.cargando = true;
            $http.post(`${URL}buscar_cliente.php?p=${busqueda}`,{headers: {'Authorization':localStorage.getItem('apptoken')}})
            .then(response => {
                console.log(response);
                self.cargando = false;
                self.clientes = response.clientes;
                q.resolve();
            })
            return q.promise()
        }
    }
    return self
}])