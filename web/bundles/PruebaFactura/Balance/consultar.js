prueba
.config([
    "$stateProvider",
    function ($stateProvider) {
        $stateProvider.state( "consultar-balance", {
            url: "/Consultar/Balance",
            views: {
                "main": {
                    controller: "ConsultarBalanceCtrl",
                    templateUrl: "/copservir/web/bundles/PruebaFactura/Balance/consultar.tpl.html"
                }
            },
            data:{
                title: "Consultar Balance Factura"
            },
            resolve: {
                $b: ["$q",
                "$stateParams",
                "Factura",
                function ($q, $stateParams, Factura) {
                    return $q.all({
                        Facturas: Factura.query().$promise
                    });
                }]
            }
        });
    }
]).controller("ConsultarBalanceCtrl", [
"$scope",
"Factura",
"$b",
function ($scope, Factura, $b) {
    angular.extend($scope, $b);
}]);
