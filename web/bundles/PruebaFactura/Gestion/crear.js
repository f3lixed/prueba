prueba
.config([
    "$stateProvider",
    function ($stateProvider) {
        $stateProvider.state( "crear-factura", {
            url: "/Crear/Factura",
            views: {
                "main": {
                    controller: "CrearFacturaCtrl",
                    templateUrl: "/copservir/web/bundles/PruebaFactura/Gestion/crear.tpl.html"
                }
            },
            data:{
                title: "Crear Factura"
            },
            resolve: {
                $b: ["$q",
                "$stateParams",
                "CrearFactura",
                function ($q, $stateParams, CrearFactura) {
                    return $q.all({
                        Productos: CrearFactura.query().$promise
                    });
                }]
            }
        });
    }
]).controller("CrearFacturaCtrl", [
"$scope",
"CrearFactura",
"FacturaProducto",
"$b",
function ($scope, CrearFactura, FacturaProducto, $b) {
    $scope.productos = $b.Productos;
    $scope.datos = {};
    $scope.validator = {total: 0, subtotal: 0, subtotaliva: 0};
    $scope.hideAlert = function () {
        $scope.validator.alert = {};
    };

    $scope.setValor = function (pre) {
        valor = pre.cantidad? pre.cantidad: 0;
        subtotal = pre.subtotal? pre.subtotal: 0;
        subtotaliva = pre.subtotaliva? pre.subtotaliva: 0;
    };

    $scope.setTotal = function (pre) {
        var container = $scope.validator;
        if (pre.cantidad) {
            pre.subtotal = pre.precio * pre.cantidad;
            pre.subtotaliva = parseInt((((pre.precio * pre.valor)/100))*pre.cantidad);
            container.total -= valor;
            container.total = (container.total + pre.cantidad);
            container.subtotal -= subtotal;
            container.subtotal = (container.subtotal + (pre.precio * pre.cantidad));
            container.subtotaliva -= subtotaliva;
            container.subtotaliva = parseInt(container.subtotaliva + ((((pre.precio * pre.valor)/100))*pre.cantidad));
        } else if (valor) {
            container.total -= valor;
            container.subtotal -= subtotal;
            container.subtotaliva -= subtotaliva;
            pre.subtotal = 0;
            pre.subtotaliva = 0;
            pre.cantidad = 0;
        }else{
            pre.cantidad = 0;
            pre.subtotal = 0;
            pre.subtotaliva = 0;
        }
    };

    $scope.saveFactura = function () {
        $scope.datos.descripcion = $scope.factura.descripcion;
        $scope.datos.total = $scope.validator.total;
        $scope.datos.subtotal = $scope.validator.subtotal;
        $scope.datos.subtotaliva = $scope.validator.subtotaliva;
        $scope.datos.productos = $scope.productos;
        facturaproducto = new FacturaProducto($scope.datos);
        facturaproducto.$save(callbackSave);
    };


    function calcularTotal() {
        var total = 0;
        for (var i=0, pres; pres = $scope.productos[i]; i++) {
            total += pres.cantidad;
        }
        return total;
    }

    function callbackSave(data) {
        if (data.content) {
            $scope.validator.alert = data;
            if (data.producto_id) {
                $scope.productos = $b.productos;
            }
        }
    }
}]);
