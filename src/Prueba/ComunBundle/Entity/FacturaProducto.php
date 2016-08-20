<?php

namespace Prueba\ComunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * FacturaProducto
 *
 * @ORM\Table(name="factura_producto")})
 * @ORM\Entity(repositoryClass="Prueba\ComunBundle\Entity\FacturaProductoRepository")
 */
class FacturaProducto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="factura_producto_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $facturaProductoId;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_total", type="integer")
     */
    private $valorTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_iva", type="integer")
     */
    private $valorIva;

    /**
     * @var integer
     *
     * @ORM\Column(name="producto_id", type="integer")
     */
    private $productoId;

    /**
     * @var integer
     *
     * @ORM\Column(name="factura_id", type="integer")
     */
    private $facturaId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true, options={"comment":"Fecha en que se registra producto en la factura"})
     */
    private $fechaRegistro;


    /**
     * Get facturaProductoId
     *
     * @return integer 
     */
    public function getFacturaProductoId()
    {
        return $this->facturaProductoId;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return FacturaProducto
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return FacturaProducto
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set valorIva
     *
     * @param integer $valorIva
     * @return FacturaProducto
     */
    public function setValorIva($valorIva)
    {
        $this->valorIva = $valorIva;

        return $this;
    }

    /**
     * Get valorIva
     *
     * @return integer 
     */
    public function getValorIva()
    {
        return $this->valorIva;
    }

    /**
     * Set valorTotal
     *
     * @param integer $valorTotal
     * @return FacturaProducto
     */
    public function setValorTotal($valorTotal)
    {
        $this->valorTotal = $valorTotal;

        return $this;
    }

    /**
     * Get valorTotal
     *
     * @return integer 
     */
    public function getValorTotal()
    {
        return $this->valorTotal;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return FacturaProducto
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set productoId
     *
     * @param integer $productoId
     * @return Producto
     */
    public function setProductoId($productoId)
    {
        $this->productoId = $productoId;

        return $this;
    }

    /**
     * Get productoId
     *
     * @return integer 
     */
    public function getProductoId()
    {
        return $this->productoId;
    }

    /**
     * Set facturaId
     *
     * @param integer $facturaId
     * @return Producto
     */
    public function setFacturaId($facturaId)
    {
        $this->facturaId = $facturaId;

        return $this;
    }

    /**
     * Get facturaId
     *
     * @return integer 
     */
    public function getFacturaId()
    {
        return $this->facturaId;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Producto")
     * @ORM\JoinColumn(name="producto_id", referencedColumnName="producto_id")
     * @return integer
     */
    private $producto;
    public function setProducto(\Prueba\ComunBundle\Entity\Producto $producto)
    {
        $this->producto = $producto;
        $this->productoId = $producto->getProductoId();
    }
    
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * @ORM\ManyToOne(targetEntity="Factura")
     * @ORM\JoinColumn(name="factura_id", referencedColumnName="factura_id")
     * @return integer
     */
    private $factura;
    public function setFactura(\Prueba\ComunBundle\Entity\Factura $factura)
    {
        $this->factura = $factura;
        $this->facturaId = $factura->getFacturaId();
    }
    
    public function getFactura()
    {
        return $this->factura;
    }

    
}