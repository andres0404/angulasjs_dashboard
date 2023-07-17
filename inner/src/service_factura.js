var appFact = angular.module('service.factura',[
    'config.conf'
])
.factory('Factura', ['$http','$q', 'URL', function ($http, $q, URL){
    var self = {
        numero_factura	:undefined,
        fecha_solicitado: new Date(),
        monto: 0,
        impuesto: 0,
        monto_neto: 0,
        estado: 'E',
        comentario:undefined,
        cliente_id: undefined,
        ISV: 0,
        detalle:[],
        nueva_factura: () =>{
            self.numero_factura = undefined;
            self.fecha_solicitado = new Date();
            self.estado = 'E' ;
            self.comentario = undefined;
            self.cliente_id = undefined;
            self.detalle = [] ;
        },
        recalcular: () => {
            // calcular los montos
            self.monto = 0;
            for (item of self.detalle) {
                self.monto += item.precio_unitario*item.cantidad
            }
            self.impuesto = self.monto * self.ISV;
            self.monto_neto = self.monto * self.impuesto;
        },
        agregar_detalle: (agregar) => {
            self.detalle.push(agregar);
            self.recalcular();
        },
        buscar_producto: ( id ) => {
            var q = $q.defer();
            $http.get(`${URL}`, {headers:{'Authorization':localStorage.getItem('apptoken')}})
            .then( response => {
                q.resolve();
            })
            return q.promise();
        },
        borrar_detalle: (item) => {
            var idx = self.detalle.indexOf(item);
            self.detalle.splice(idx,1);
            self.recalcular();
        },
        guardar_factura: () => {
            $http.post(`${URL}`,{headers:{'Authorization':localStorage.getItem('apptoken')},data:self})
            .then( response => {
                console.log(response)
            });
            return true; 
        }
    }
    return self;
}]);