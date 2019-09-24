<?php

namespace BackendBundle\Entity;

/**
 * Horario
 */
class Horario
{
    /**
     * @var integer
     */
    private $idHorario;

    /**
     * @var string
     */
    private $dia;

    /**
     * @var string
     */
    private $hora;

    /**
     * @var boolean
     */
    private $borrado;

    /**
     * @var \BackendBundle\Entity\Laboratorio
     */
    private $refLaboratorio;


    /**
     * Get idHorario
     *
     * @return integer
     */
    public function getIdHorario()
    {
        return $this->idHorario;
    }

    /**
     * Set dia
     *
     * @param string $dia
     *
     * @return Horario
     */
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * Get dia
     *
     * @return string
     */
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set hora
     *
     * @param string $hora
     *
     * @return Horario
     */
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get hora
     *
     * @return string
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set borrado
     *
     * @param boolean $borrado
     *
     * @return Horario
     */
    public function setBorrado($borrado)
    {
        $this->borrado = $borrado;

        return $this;
    }

    /**
     * Get borrado
     *
     * @return boolean
     */
    public function getBorrado()
    {
        return $this->borrado;
    }

    /**
     * Set refLaboratorio
     *
     * @param \BackendBundle\Entity\Laboratorio $refLaboratorio
     *
     * @return Horario
     */
    public function setRefLaboratorio(\BackendBundle\Entity\Laboratorio $refLaboratorio = null)
    {
        $this->refLaboratorio = $refLaboratorio;

        return $this;
    }

    /**
     * Get refLaboratorio
     *
     * @return \BackendBundle\Entity\Laboratorio
     */
    public function getRefLaboratorio()
    {
        return $this->refLaboratorio;
    }
}
