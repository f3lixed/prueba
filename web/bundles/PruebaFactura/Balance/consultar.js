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
                "$location",
                "Factura",
                function ($q, $location, Factura) {
                    var location = $location.search();
                    return $q.all({
                        facturas: Factura.query(location).$promise
                    });
                }]
            }
        });
    }
]).controller("ConsultarBalanceCtrl", [
"$scope",
"$location",
"Factura",
"$b",
function ($scope, $location, Factura, $b) {
    angular.extend($scope, $b);
    console.log($scope.facturas);
    $scope.balance = {total:0};
    $scope.balance.total = calcularTotal();

    $scope.dataSearch = angular.extend({
        numeroPagina: 1
    }, $location.search());

    function calcularTotal() {
        var total = 0, i=0, factura = $scope.facturas[0].data;

        for (var i in factura) {
            total += factura[i].total;
        }
        return total;
    }
}]);
