var app = angular.module('facturacionApp',[
    'ngRoute',
    'jcs-autoValidate',
    'service.info',
    'service.mensajes',
    'service.notificaciones',
    'service.clientes',
    'controller.clientes'
])

app.controller('mainCtrl' , ['$scope','Configuracion','Mensajes','Notificaciones',function ($scope, Configuracion, Mensajes, Notificaciones) {
    $scope.configuracion = Configuracion
    $scope.configuracion.cargar().then(() => {
        $scope.config = {
            aplicativo: "Ejercicio de Angular JS",
            iniciales: $scope.configuracion.info.iniciales,
            version: $scope.configuracion.info.version,
            anio: $scope.configuracion.info.year,
            empresa: $scope.configuracion.info.enterprise
        }
    });
    $scope.usuario = {
        nombre: "Goku"
    }

    var msgService = Mensajes
    msgService.cargar().then(() => {
        $scope.mensajes = msgService.mensajes
        
    })

    var ntfService = Notificaciones
    ntfService.cargar().then(() => {
        $scope.notificaciones = ntfService.notificaciones
    })

    // iluminar elemento del menu
    
    $scope.activar = (menu, submenu, titulo, subtitulo) => {
        $scope.mDashboard = ""
        $scope.mClientes = ""
        $scope[menu] = "active"
        $scope.titulo = titulo
        $scope.subtitulo = subtitulo
    }
}])
.filter('quitarletra', () => {
    return (palabra) => {
        if(palabra) {
            if( palabra.length > 1 )
                return palabra.substr(1)
            return palabra
        }
    }
})
.filter('mensajecorto', () => {
    return (mensaje) => {
        if(mensaje.length > 35 )
            return mensaje.substr(0,35) + "..."
        return mensaje
    }
})

angular.module('jcs-autoValidate')
.run([
    'defaultErrorMessageResolver',
    function (defaultErrorMessageResolver) {
        defaultErrorMessageResolver.setI18nFileRootPath('bower_components/angular-auto-validate/dist/lang')
        defaultErrorMessageResolver.setCulture('es-co')
    }
])