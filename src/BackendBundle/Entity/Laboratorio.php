<?php

namespace BackendBundle\Entity;

/**
 * Laboratorio
 */
class Laboratorio
{
    /**
     * @var integer
     */
    private $idLaboratorio;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $ubicacion;

    /**
     * @var string
     */
    private $instituto;

    /**
     * @var string
     */
    private $equipotrabajo;

    /**
     * @var string
     */
    private $perfil;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $tiposexperimentos;

    /**
     * @var string
     */
    private $equipos;

    /**
     * @var boolean
     */
    private $borrado;

    /**
     * @var \BackendBundle\Entity\Responsable
     */
    private $refResponsable;


    /**
     * Get idLaboratorio
     *
     * @return integer
     */
    public function getIdLaboratorio()
    {
        return $this->idLaboratorio;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Laboratorio
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
     * Set ubicacion
     *
     * @param string $ubicacion
     *
     * @return Laboratorio
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return string
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set instituto
     *
     * @param string $instituto
     *
     * @return Laboratorio
     */
    public function setInstituto($instituto)
    {
        $this->instituto = $instituto;

        return $this;
    }

    /**
     * Get instituto
     *
     * @return string
     */
    public function getInstituto()
    {
        return $this->instituto;
    }

    /**
     * Set equipotrabajo
     *
     * @param string $equipotrabajo
     *
     * @return Laboratorio
     */
    public function setEquipotrabajo($equipotrabajo)
    {
        $this->equipotrabajo = $equipotrabajo;

        return $this;
    }

    /**
     * Get equipotrabajo
     *
     * @return string
     */
    public function getEquipotrabajo()
    {
        return $this->equipotrabajo;
    }

    /**
     * Set perfil
     *
     * @param string $perfil
     *
     * @return Laboratorio
     */
    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;

        return $this;
    }

    /**
     * Get perfil
     *
     * @return string
     */
    public function getPerfil()
    {
        return $this->perfil;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Laboratorio
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
     * Set tiposexperimentos
     *
     * @param string $tiposexperimentos
     *
     * @return Laboratorio
     */
    public function setTiposexperimentos($tiposexperimentos)
    {
        $this->tiposexperimentos = $tiposexperimentos;

        return $this;
    }

    /**
     * Get tiposexperimentos
     *
     * @return string
     */
    public function getTiposexperimentos()
    {
        return $this->tiposexperimentos;
    }

    /**
     * Set equipos
     *
     * @param string $equipos
     *
     * @return Laboratorio
     */
    public function setEquipos($equipos)
    {
        $this->equipos = $equipos;

        return $this;
    }

    /**
     * Get equipos
     *
     * @return string
     */
    public function getEquipos()
    {
        return $this->equipos;
    }

    /**
     * Set borrado
     *
     * @param boolean $borrado
     *
     * @return Laboratorio
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
     * Set refResponsable
     *
     * @param \BackendBundle\Entity\Responsable $refResponsable
     *
     * @return Laboratorio
     */
    public function setRefResponsable(\BackendBundle\Entity\Responsable $refResponsable = null)
    {
        $this->refResponsable = $refResponsable;

        return $this;
    }

    /**
     * Get refResponsable
     *
     * @return \BackendBundle\Entity\Responsable
     */
    public function getRefResponsable()
    {
        return $this->refResponsable;
    }
}

