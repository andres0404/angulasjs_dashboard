var appClientes = angular.module('service.clientes',[])
.factory('Clientes',['$http','$q',($http, $q) => {
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
            console.log("guardando cliente", cliente);
            $http.post('http://localhost:8080/php/service_post_clientes.php', cliente)
            .then(response => {
                console.log(response);
                q.resolve()
            })
            .catch(error => {
                q.reject()
            })  
            return q.promise;
        },
        cargarPagina: (pag = 1) => {
            var q = $q.defer()
            $http.get(`http://localhost:8080/php/service_clientes.php?pag=${pag}`)
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
        }
    }
    return self
}])