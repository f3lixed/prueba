<?php

namespace Prueba\ComunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * Producto
 *
 * @ORM\Table(name="producto")})
 * @ORM\Entity(repositoryClass="Prueba\ComunBundle\Entity\ProductoRepository")
 */
class Producto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="producto_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $productoId;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=150)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="integer")
     */
    private $precio;

    /**
     * @var integer
     *
     * @ORM\Column(name="categoria_id", type="integer")
     */
    private $categoriaId;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipos_iva_id", type="integer")
     */
    private $tiposIvaId;


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
     * Set nombre
     *
     * @param string $nombre
     * @return Producto
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set precio
     *
     * @param string $precio
     * @return Producto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set categoriaId
     *
     * @param integer $categoriaId
     * @return Producto
     */
    public function setCategoriaId($categoriaId)
    {
        $this->categoriaId = $categoriaId;

        return $this;
    }

    /**
     * Get categoriaId
     *
     * @return integer 
     */
    public function getCategoriaId()
    {
        return $this->categoriaId;
    }

    /**
     * Set tiposIvaId
     *
     * @param integer $tiposIvaId
     * @return Producto
     */
    public function setTiposIvaId($tiposIvaId)
    {
        $this->tiposIvaId = $tiposIvaId;

        return $this;
    }

    /**
     * Get tiposIvaId
     *
     * @return integer 
     */
    public function getTiposIvaId()
    {
        return $this->tiposIvaId;
    }
    
    /**
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="categoria_id")
     * @return integer
     */
    private $categoria;
    public function setCategoria(\Prueba\ComunBundle\Entity\Categoria $categoria)
    {
        $this->categoria = $categoria;
        $this->categoriaId = $categoria->getCategoriaId();
    }
    
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @ORM\ManyToOne(targetEntity="TiposIva")
     * @ORM\JoinColumn(name="tipos_iva_id", referencedColumnName="tipos_iva_id")
     * @return integer
     */
    private $tiposIva;
    public function setTiposIva(\Prueba\ComunBundle\Entity\TiposIva $tiposIva)
    {
        $this->tiposIva = $tiposIva;
        $this->tiposIvaId = $tiposIva->getTiposIvaId();
    }
    
    public function getTiposIva()
    {
        return $this->tiposIva;
    }
}