<?php

namespace BackendBundle\Entity;

/**
 * Responsable
 */
class Responsable
{
    /**
     * @var integer
     */
    private $idResponsable;

    /**
     * @var string
     */
    private $rut;

    /**
     * @var integer
     */
    private $nivel;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $apellido;

    /**
     * @var integer
     */
    private $numeroTelefono;

    /**
     * @var string
     */
    private $clave;

    /**
     * @var string
     */
    private $correo;

    /**
     * @var boolean
     */
    private $borrado;


    /**
     * Get idResponsable
     *
     * @return integer
     */
    public function getIdResponsable()
    {
        return $this->idResponsable;
    }

    /**
     * Set rut
     *
     * @param string $rut
     *
     * @return Responsable
     */
    public function setRut($rut)
    {
        $this->rut = $rut;

        return $this;
    }

    /**
     * Get rut
     *
     * @return string
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Set nivel
     *
     * @param integer $nivel
     *
     * @return Responsable
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return integer
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Responsable
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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Responsable
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set numeroTelefono
     *
     * @param integer $numeroTelefono
     *
     * @return Responsable
     */
    public function setNumeroTelefono($numeroTelefono)
    {
        $this->numeroTelefono = $numeroTelefono;

        return $this;
    }

    /**
     * Get numeroTelefono
     *
     * @return integer
     */
    public function getNumeroTelefono()
    {
        return $this->numeroTelefono;
    }

    /**
     * Set clave
     *
     * @param string $clave
     *
     * @return Responsable
     */
    public function setClave($clave)
    {
        $this->clave = $clave;

        return $this;
    }

    /**
     * Get clave
     *
     * @return string
     */
    public function getClave()
    {
        return $this->clave;
    }

    /**
     * Set correo
     *
     * @param string $correo
     *
     * @return Responsable
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set borrado
     *
     * @param boolean $borrado
     *
     * @return Responsable
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
}

