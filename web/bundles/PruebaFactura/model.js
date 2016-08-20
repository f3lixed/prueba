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
        return $resource(ROOT + "copservir/web/app_dev.php/consultarfactura", {
            factura_id: "@factuta_id"
        });
    }
])
.factory("FacturaProductos", [
    "$resource",
    "ROOT",
    function ($resource, ROOT) {
        return $resource(ROOT + "copservir/web/app_dev.php/consultarfacturaproductos", {
            factura_id: "@factuta_id"
        });
    }
]);