<?php

namespace BackendBundle\Entity;

/**
 * Solicitud
 */
class Solicitud
{
    /**
     * @var integer
     */
    private $idSolicitud;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var boolean
     */
    private $borrado;

    /**
     * @var \BackendBundle\Entity\Horario
     */
    private $refHorario;

    /**
     * @var \BackendBundle\Entity\Usuario
     */
    private $refUsuario;


    /**
     * Get idSolicitud
     *
     * @return integer
     */
    public function getIdSolicitud()
    {
        return $this->idSolicitud;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Solicitud
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set borrado
     *
     * @param boolean $borrado
     *
     * @return Solicitud
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
     * Set refHorario
     *
     * @param \BackendBundle\Entity\Horario $refHorario
     *
     * @return Solicitud
     */
    public function setRefHorario(\BackendBundle\Entity\Horario $refHorario = null)
    {
        $this->refHorario = $refHorario;

        return $this;
    }

    /**
     * Get refHorario
     *
     * @return \BackendBundle\Entity\Horario
     */
    public function getRefHorario()
    {
        return $this->refHorario;
    }

    /**
     * Set refUsuario
     *
     * @param \BackendBundle\Entity\Usuario $refUsuario
     *
     * @return Solicitud
     */
    public function setRefUsuario(\BackendBundle\Entity\Usuario $refUsuario = null)
    {
        $this->refUsuario = $refUsuario;

        return $this;
    }

    /**
     * Get refUsuario
     *
     * @return \BackendBundle\Entity\Usuario
     */
    public function getRefUsuario()
    {
        return $this->refUsuario;
    }
}

