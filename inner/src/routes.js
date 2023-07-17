app.config (['$routeProvider', ($routeProvider) => {
    $routeProvider
    .when('/d',{
        templateUrl: 'template/dashboard.html',
        controller:"pCtrl"
    })
    .when('/clientes/:pag',{
        templateUrl: "template/clientes.html",
        controller: 'clientesCtrl'
    })
    .when('/nuevafactura',{
        templateUrl: 'template/nueva_factura.html',
        controller: 'facturaCtrl'
    })
    .when('/facturas',{
        templateUrl: 'template/facturas.html',
        controller: ""
    })
    .otherwise({
        redirectTo: '/'
    })
}])