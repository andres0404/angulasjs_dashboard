app.config (['$routeProvider', ($routeProvider) => {
    $routeProvider
    .when('/d',{
        templateUrl: '../template/dashboard.html',
        controller:"pCtrl"
    })
    .when('/clientes/:pag',{
        templateUrl: "../template/clientes.html",
        controller: 'clientesCtrl'
    })
    .otherwise({
        redirectTo: '/'
    })
}])