prueba
.config([
    "$stateProvider",
    function ($stateProvider) {
        $stateProvider.state( "detalle-factura", {
            url: "/Consultar/Balance/:factura_id?",
            views: {
                "main": {
                    controller: "ConsultarBalanceDetalleCtrl",
                    templateUrl: "/copservir/web/bundles/PruebaFactura/Balance/detalle.tpl.html"
                }
            },
            data:{
                title: "Consultar BalancevDetalle Factura"
            },
            resolve: {
                $b: ["$q",
                "$stateParams",
                "FacturaProductos",
                function ($q, $stateParams, FacturaProductos) {
                    var productosFactura = {},
                    if ($stateParams.factura_id) {
                        productosFactura = FacturaProductos.get($stateParams).$promise;
                    }
                    return $q.all({
                        productos: productosFactura
                    });
                }]
            }
        });
    }
]).controller("ConsultarBalanceDetalleCtrl", [
"$scope",
"FacturaProductos",
"$b",
function ($scope, FacturaProductos, $b) {
    angular.extend($scope, $b);
}]);
