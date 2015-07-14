<?php
/**
 * Created by PhpStorm.
 * User: DIAZ
 * Date: 12/07/2015
 * Time: 07:13 PM
 */
require_once 'EntidadBase.php';
class TipoSolucion extends EntidadBase {


    private $nombre;

    function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function __toString()
    {
        return ('TipoSolucion: '.$this->getId().', '.
            $this->getNombre());

    }
}