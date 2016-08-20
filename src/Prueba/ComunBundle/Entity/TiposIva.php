<?php

namespace Prueba\ComunBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * TiposIva
 *
 * @ORM\Table(name="tipos_iva", uniqueConstraints={@UniqueConstraint(name="idx_form_valor",columns={"valor"})})
 * @ORM\Entity(repositoryClass="Prueba\ComunBundle\Entity\TiposIvaRepository")
 */
class TiposIva
{
    /**
     * @var integer
     *
     * @ORM\Column(name="tipos_iva_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     */
    private $tiposIvaId;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="integer")
     */
    private $valor;

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
     * Set valor
     *
     * @param integer $valor
     * @return TiposIva
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return integer 
     */
    public function getValor()
    {
        return $this->valor;
    }

}