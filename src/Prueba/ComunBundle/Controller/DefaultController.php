<?php

namespace Prueba\ComunBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Response;
use Prueba\ComunBundle\Entity\Producto;
use Prueba\ComunBundle\Entity\Factura;
use Prueba\ComunBundle\Entity\FacturaProducto;
use Prueba\ComunBundle\Entity\TiposIva;
class DefaultController extends Controller
{
    public function indexAction()
    {
        
        return $this->render('PruebaComunBundle:Default:index.html.twig');
    }

    public function crearFacturaAction()
    {
    	$em = $this->getDoctrine()->getManager();

        $data = json_decode(file_get_contents('php://input'));

        if (!empty($data)) {
            $categoriaId = $data->categoria_id;
        }else{
            $categoriaId = null;
        }
        
        try{
            if ($categoriaId!=null) {
                $objeto = $em->getRepository('PruebaComunBundle:Producto')->findBy(
                                            array(
                                                'categoriaId' => $categoriaId
                                            )
                                        );
            }else{
                $objeto = $em->getRepository('PruebaComunBundle:Producto')->findAll();
            }

            for ($i=0; $i < sizeof($objeto); $i++) { 
            $info[$i] = array('producto_id' => $objeto[$i]->getProductoId(),
                'nombre' => $objeto[$i]->getNombre(), 'precio' => $objeto[$i]->getPrecio(), 'tipos_iva_id' => $objeto[$i]->getTiposIvaId(),
                'valor' => $objeto[$i]->getTiposIva()->getValor(), 'cantidad' => 0, 'subtotal' => 0, 'subtotaliva' => 0);
        }
        }catch(\Exception $e){
            $objSQLException = new \Prueba\ComunBundle\Resources\classes\SQLException();
            $info = array('type' => 'danger', 'content' => $objSQLException->getSQLState($e->getMessage(),__LINE__));
        }
        
        $serializer = SerializerBuilder::create()->build();
        return new Response($serializer->serialize($info,'json'));
    }

    public function generarFacturaAction()
    {
        $em = $this->getDoctrine()->getManager();
        $data = json_decode(file_get_contents('php://input'));
        try{
            $factura = new Factura();
            $factura->setDescripcion($data->descripcion);
            $factura->setFechaRegistro(new \Datetime (date('Y-m-d')));
            $total = ($data->subtotal + $data->subtotaliva);
            $factura->setTotal($total);
            $factura->setValorBase($data->subtotal);
            $factura->setValorIva($data->subtotaliva);
            $em->persist($factura);
            $i=0;
            foreach ($data->productos as $key => $value) {

                if ($data->productos[$key]->cantidad) {
                    $producto = $em->getRepository('PruebaComunBundle:Producto')->findBy(
                                                array(
                                                    'productoId' => $data->productos[$key]->producto_id
                                                )
                                            );
                    $facturaProducto = new FacturaProducto();
                    $facturaProducto->setProducto($em->getReference('\Prueba\ComunBundle\Entity\Producto', $producto[0]->getProductoId()));
                    $facturaProducto->setCantidad($data->productos[$key]->cantidad);
                    $facturaProducto->setFactura($factura);
                    $facturaProducto->setValorTotal($data->productos[$key]->subtotal);
                    $facturaProducto->setValorIva($data->productos[$key]->subtotaliva);
                    $facturaProducto->setFechaRegistro(new \Datetime (date('Y-m-d')));
                    $em->persist($facturaProducto);
                }
                $i++;
            }
            $em->flush();
            $em->clear();
            
            $info = array('type' => 'success', 'content' => 'Factura: '.$factura->getfacturaId().' CREADO ', 
                          'nivel_atencion_id' => $factura->getfacturaId());
        }catch(\Exception $e){
            $objSQLException = new \Prueba\ComunBundle\Resources\classes\SQLException();
            $info = array('type' => 'danger', 'content' => $objSQLException->getSQLState($e->getMessage(),__LINE__));
        }
    
        $response = new Response(json_encode($info));
        $response->headers->set('Content-type', 'application/json');
        return $response;
    }

    public function consultarFacturaAction()
    {
        $em = $this->getDoctrine()->getManager();

        $data = json_decode(file_get_contents('php://input'));
        $serializer = SerializerBuilder::create()->build();

        if (!empty($data->factura_id)) {
            $facturaId = $data->factura_id;
        }else{
            $facturaId = null;
        }
        
        try{
            if ($facturaId!=null) {
                $objeto = $em->getRepository('PruebaComunBundle:Factura')->findBy(
                                            array(
                                                'facturaId' => $facturaId
                                            )
                                        );
            }else{
                $hoy = date('Y-m-d');
                $objeto = $em->getRepository('PruebaComunBundle:Factura')->findBy(array(
                    "fechaRegistro" => new \DateTime(date('Y-m-d'))
                ));
                for ($i=0; $i < sizeof($objeto); $i++) { 
                    $datos[$i] = array('factura_id' => $objeto[$i]->getFacturaId(),
                        'descripcion' => $objeto[$i]->getDescripcion(), 'total' => $objeto[$i]->getTotal(), 'valor_base' => $objeto[$i]->getValorBase(),
                        'valor_iva' => $objeto[$i]->getValorIva());
                }
            }

            $cantD = $i;
        }catch(\Exception $e){
            $cantD = 0;
            $objSQLException = new \Prueba\ComunBundle\Resources\classes\SQLException();
            $datos = array('type' => 'danger', 'content' => $objSQLException->getSQLState($e->getMessage(),__LINE__));
        }
        
        $serializer = SerializerBuilder::create()->build();
        return new Response("[{\"cantidad\":10,\"total\":$cantD,\"data\":".$serializer->serialize($datos, 'json')."}]");
    }

    public function consultarFacturaProductosAction($facturaId)
    {
        $em = $this->getDoctrine()->getManager();

        $data = json_decode(file_get_contents('php://input'));
        $serializer = SerializerBuilder::create()->build();

        $request = $this->getRequest();
            $numero = $request->query->get('factura_id');

        print_r($facturaId,true);
        
        try{
            $objeto = 0;
                $objeto = $em->getRepository('PruebaComunBundle:FacturaProductos')->findBy(
                                            array(
                                                'facturaId' => $data->factura_id
                                            )
                                        );

            $cantD = sizeof($objeto);
        }catch(\Exception $e){
            $cantD = 0;
            $objSQLException = new \Prueba\ComunBundle\Resources\classes\SQLException();
            $datos = array('type' => 'danger', 'content' => $objSQLException->getSQLState($e->getMessage(),__LINE__));
        }
        
        $serializer = SerializerBuilder::create()->build();
        return new Response("[{\"cantidad\":10,\"total\":$cantD,\"data\":".$serializer->serialize($objeto, 'json')."}]");
    }
}
