prueba
.factory("CrearFactura", [
    "$resource",
    "ROOT",
    function ($resource, ROOT) {
        return $resource(ROOT + "copservir/web/app_dev.php/crearfactura");
    }
])
.factory("FacturaProducto", [
    "$resource",
    "ROOT",
    function ($resource, ROOT) {
        return $resource(ROOT + "copservir/web/app_dev.php/generarfactura");
    }
])
.factory("Factura", [
    "$resource",
    "ROOT",
    function ($resource, ROOT) {
        return $resource(ROOT + "copservir/web/app_dev.php/consultarfactura");
    }
]);