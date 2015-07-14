<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 12/07/2015
 * Time: 07:08 PM
 */

require_once 'TipoSolucion.php';
require_once 'TipoRevision.php';
require_once 'TipoDespacho.php';
require_once 'Miembro.php';
require_once 'EntidadBase.php';
class Requerimiento extends EntidadBase{


    private $Creador;
    private $nombreSolicitante;
    private $tlfSolicitante;
    private $TipoRevision;
    private $observaciones;
    private $ip;
    private $direccionEquipo;
    private $privilegios;
    private $TipoSolucion;
    private $TipoDespacho;
    private $Tecnico;
    private $usuario_notificado;

    function __construct()
    {
        $this->Creador = new Miembro();
        $this->Tecnico = new Miembro();
        $this->TipoDespacho = new TipoDespacho();
        $this->TipoRevision = new TipoRevision();
        $this->TipoSolucion = new TipoSolucion();
    }


    /**
     * @return mixed
     */
    public function getCreador()
    {
        return $this->Creador;
    }

    /**
     * @param mixed $Creador
     */
    public function setCreador(Miembro $Creador)
    {
        $this->Creador = $Creador;
    }

    /**
     * @return mixed
     */
    public function getNombreSolicitante()
    {
        return $this->nombreSolicitante;
    }

    /**
     * @param mixed $nombreSolicitante
     */
    public function setNombreSolicitante($nombreSolicitante)
    {
        $this->nombreSolicitante = $nombreSolicitante;
    }

    /**
     * @return mixed
     */
    public function getTlfSolicitante()
    {
        return $this->tlfSolicitante;
    }

    /**
     * @param mixed $tlfSolicitante
     */
    public function setTlfSolicitante($tlfSolicitante)
    {
        $this->tlfSolicitante = $tlfSolicitante;
    }

    /**
     * @return mixed
     */
    public function getTipoRevision()
    {
        return $this->TipoRevision;
    }

    /**
     * @param mixed $TipoRevision
     */
    public function setTipoRevision(TipoRevision $TipoRevision)
    {
        $this->TipoRevision = $TipoRevision;
    }

    /**
     * @return mixed
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * @param mixed $observaciones
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getDireccionEquipo()
    {
        return $this->direccionEquipo;
    }

    /**
     * @param mixed $direccionEquipo
     */
    public function setDireccionEquipo($direccionEquipo)
    {
        $this->direccionEquipo = $direccionEquipo;
    }

    /**
     * @return mixed
     */
    public function getPrivilegios()
    {
        return $this->privilegios;
    }

    /**
     * @param mixed $privilegios
     */
    public function setPrivilegios($privilegios)
    {
        $this->privilegios = $privilegios;
    }

    /**
     * @return mixed
     */
    public function getTipoSolucion()
    {
        return $this->TipoSolucion;
    }

    /**
     * @param mixed $TipoSolucion
     */
    public function setTipoSolucion(TipoSolucion $TipoSolucion)
    {
        $this->TipoSolucion = $TipoSolucion;
    }

    /**
     * @return mixed
     */
    public function getTipoDespacho()
    {
        return $this->TipoDespacho;
    }

    /**
     * @param mixed $TipoDespacho
     */
    public function setTipoDespacho(TipoDespacho $TipoDespacho)
    {
        $this->TipoDespacho = $TipoDespacho;
    }

    /**
     * @return mixed
     */
    public function getTecnico()
    {
        return $this->tecnico;
    }

    /**
     * @param mixed $tecnico
     */
    public function setTecnico(Miembro $tecnico)
    {
        $this->tecnico = $tecnico;
    }

    /**
     * @return mixed
     */
    public function getUsuarioNotificado()
    {
        return $this->usuario_notificado;
    }

    /**
     * @param mixed $usuario_notificado
     */
    public function setUsuarioNotificado($usuario_notificado)
    {
        $this->usuario_notificado = $usuario_notificado;
    }


    function __toString()
    {
        return ('Requerimiento: '.$this->getId().', '.
            $this->getCreador()->toString().', '.
            $this->getNombreSolicitante().', '.
            $this->getTlfSolicitante().', '.
            $this->getTipoRevision()->toString().', '.
            $this->getObservaciones().', '.
            $this->getIp().', '.
            $this->getDireccionEquipo().', '.
            $this->getPrivilegios().', '.
            $this->getTipoSolucion()->toString().', '.
            $this->getTipoDespacho()->toString().', '.
            $this->getTecnico()->toString().', '.
            $this->getUsuarioNotificado());

    }

}