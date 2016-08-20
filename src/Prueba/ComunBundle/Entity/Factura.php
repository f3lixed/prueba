<?php

namespace Prueba\ComunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Factura
 *
 * @ORM\Table(name="Factura")})
 * @ORM\Entity(repositoryClass="Prueba\ComunBundle\Entity\FacturaRepository")
 */
class Factura
{
    /**
     * @var integer
     *
     * @ORM\Column(name="factura_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $facturaId;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=60)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="datetime", nullable=true, options={"comment":"Fecha en que se registra la factura"})
     */
    private $fechaRegistro;

    /**
     * @var integer
     *
     * @ORM\Column(name="total", type="integer")
     */
    private $total;

    /**
     * @var integer
     *
     * @ORM\Column(name="valor_base", type="integer")
     */
    private $valorBase;

    /**
     * @var integer
     *
     * @ORM\Column(name="valor_iva", type="integer")
     */
    private $valorIva;


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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Factura
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
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return Factura
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
     * Set total
     *
     * @param integer $total
     * @return Factura
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return integer 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set valorBase
     *
     * @param integer $valorBase
     * @return Factura
     */
    public function setValorBase($valorBase)
    {
        $this->valorBase = $valorBase;

        return $this;
    }

    /**
     * Get valorBase
     *
     * @return integer 
     */
    public function getValorBase()
    {
        return $this->valorBase;
    }

    /**
     * Set valorIva
     *
     * @param integer $valorIva
     * @return Factura
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

    
}